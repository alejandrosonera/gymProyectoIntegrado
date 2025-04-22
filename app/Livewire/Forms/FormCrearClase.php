<?php

namespace App\Livewire\Forms;

use App\Models\Clase;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearClase extends Form
{
    #[Rule(['required', 'string', 'min:5', 'max:40'])]
    public string $nombre="";

    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $descripcion="";

    #[Rule(['required', 'date', 'after_or_equal:now'])]
    public string $fecha_hora="";

    #[Rule(['required', 'integer', 'min:1', 'max:100'])]
    public int $max_participantes=0;

    public function formStore() {
        $this->validate();
        Clase::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_hora' => $this->fecha_hora,
            'max_participantes' => $this->max_participantes,
            'entrenador_id' => Auth::id(),
        ]);
    }

    public function formReset() {
        $this->resetValidation();
        $this->reset();
    }

}
