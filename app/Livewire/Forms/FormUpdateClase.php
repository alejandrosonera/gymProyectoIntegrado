<?php

namespace App\Livewire\Forms;

use App\Models\Clase;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateClase extends Form
{
    public ?Clase $clase = null;


    public string $nombre="";

    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $descripcion="";

    #[Rule(['required', 'date', 'after_or_equal:now'])]
    public string $fecha_hora="";

    #[Rule(['required', 'integer', 'min:1', 'max:100'])]
    public int $max_participantes=0;

    public function rules(): array {
        $rules = [
            'nombre' => ['required', 'string', 'min:5', 'max:40', 'unique:clases,nombre,'.$this->clase?->id],
            'max_participantes' => ['required', 'integer', 'min:1', 'max:100'],
        ];

        // Solo añadir la regla personalizada si la clase ya existe
        if ($this->clase) {
            $participantesActuales = $this->clase->clientes()->count();

            // Añadir una regla más explícita
            $rules['max_participantes'][] = "min:{$participantesActuales}";

            // También mantener la regla personalizada para un mensaje más claro
            $rules['max_participantes'][] = function($attribute, $value, $fail) use ($participantesActuales) {
                if ($value < $participantesActuales) {
                    $fail("El máximo de participantes debe ser al menos {$participantesActuales} (número actual de participantes).");
                }
            };
        }

        return $rules;
    }

    public function setClase(Clase $clase) {
        $this->clase = $clase;
        $this->nombre = $clase->nombre;
        $this->descripcion = $clase->descripcion;
        $this->fecha_hora = $clase->fecha_hora;
        $this->max_participantes = $clase->max_participantes;
    }

    public function formUpdate() {
        // Validación estándar
        $this->validate();

        // Validación manual adicional
        if ($this->clase) {
            $participantesActuales = $this->clase->clientes()->count();
            if ($this->max_participantes < $participantesActuales) {
                $this->addError('max_participantes',
                    "No puedes reducir el máximo de participantes a {$this->max_participantes} porque ya hay {$participantesActuales} personas apuntadas.");
                return false;
            }
        }

        $this->clase->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_hora' => $this->fecha_hora,
            'max_participantes' => $this->max_participantes,
        ]);

        return true;
    }

    public function formReset() {
        $this->resetValidation();
        $this->reset();
    }
}
