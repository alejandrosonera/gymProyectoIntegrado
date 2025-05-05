<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateClase;
use App\Models\Clase as ModelsClase;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\WithPagination;

use function Laravel\Prompts\alert;

class Clase extends Component
{
    use WithPagination;

    public bool $showModal = false;

    public FormUpdateClase $uform;
    public bool $abrirUpdate = false;


    public string $buscar = "";
    public $usuariosApuntados = []; // Para almacenar los usuarios apuntados

    #[On('onClaseCreada')]
    public function render()
    {
        $clases = ModelsClase::with('entrenador', 'clientes')
            ->where(function ($q) {
                $q->where('nombre', 'like', "%{$this->buscar}%")
                    ->orWhere('descripcion', 'like', "%{$this->buscar}%");
            })
            ->orderBy('nombre')
            ->paginate(3);

        return view('livewire.clase', compact('clases'));
    }

    public function updatingBuscar()
    {
        $this->reset();
    }

    public function apuntarse(int $claseId)
    {
        $clase = ModelsClase::findOrFail($claseId);

        // Verificar si ya está apuntado
        if ($clase->clientes()->where('user_id', Auth::id())->exists()) {
            $this->dispatch('mensaje', 'Ya estás apuntado a esta clase.');
            return;
        }

        // Verificar si la clase tiene espacio
        $numeroParticipantes = $clase->clientes()->count(); // Contar el número de clientes asociados
        if ($numeroParticipantes >= $clase->max_participantes) {
            $this->dispatch('mensaje', 'No hay espacio disponible en esta clase.');
            return;
        }

        // Verificar si el usuario ya está apuntado a otra clase en el mismo día
        $fechaClaseActual = \Carbon\Carbon::parse($clase->fecha_hora);

        $clasesUsuario = ModelsClase::whereHas('clientes', function($query) {
            $query->where('user_id', Auth::id());
        })->get();

        foreach ($clasesUsuario as $claseUsuario) {
            $fechaClaseUsuario = \Carbon\Carbon::parse($claseUsuario->fecha_hora);

            // Verificar si es el mismo día
            if ($fechaClaseActual->isSameDay($fechaClaseUsuario)) {
                $mensaje = "No puedes apuntarte a esta clase porque ya estás inscrito en '{$claseUsuario->nombre}' ";
                $mensaje .= "el mismo día (" . $fechaClaseUsuario->format('d/m/Y') . ") ";
                $mensaje .= "a las " . $fechaClaseUsuario->format('H:i') . ".";

                $this->dispatch('mensaje', $mensaje);
                return;
            }
        }

        // Apuntar al usuario
        $clase->clientes()->attach(Auth::id());
    }

    // Nuevo método para verificar si un usuario puede apuntarse a una clase
    public function puedeApuntarse(int $claseId)
    {
        if (!Auth::check()) {
            return false;
        }

        $clase = ModelsClase::findOrFail($claseId);

        // Verificar si ya está apuntado a esta clase
        if ($clase->clientes()->where('user_id', Auth::id())->exists()) {
            return false;
        }

        // Verificar si la clase tiene espacio
        $numeroParticipantes = $clase->clientes()->count();
        if ($numeroParticipantes >= $clase->max_participantes) {
            return false;
        }

        // Verificar si el usuario ya está apuntado a otra clase en el mismo día
        $clasesUsuario = ModelsClase::whereHas('clientes', function($query) {
            $query->where('user_id', Auth::id());
        })
        ->where('fecha', $clase->fecha)
        ->get();

        if ($clasesUsuario->count() > 0) {
            foreach ($clasesUsuario as $claseUsuario) {
                // Verificar solapamiento de horarios
                if (
                    ($clase->hora_inicio >= $claseUsuario->hora_inicio && $clase->hora_inicio < $claseUsuario->hora_fin) ||
                    ($clase->hora_fin > $claseUsuario->hora_inicio && $clase->hora_fin <= $claseUsuario->hora_fin) ||
                    ($clase->hora_inicio <= $claseUsuario->hora_inicio && $clase->hora_fin >= $claseUsuario->hora_fin)
                ) {
                    return false;
                }
            }
        }

        return true;
    }



    public function desapuntarse(int $claseId)
    {
        // Obtener la clase
        $clase = ModelsClase::findOrFail($claseId);

        // Verificar si el usuario está apuntado a esta clase
        if (!$clase->clientes()->where('user_id', Auth::id())->exists()) {
            // SweetAlert de error si el usuario no está apuntado
            $this->dispatch('mensaje', 'No estás apuntado a esta clase.');
        }

        // Desapuntar al usuario de la clase
        $clase->clientes()->detach(Auth::id());

        $clase->save();
    }



    public function verUsuariosApuntados(int $claseId)
    {
        $this->showModal = true;

        $clase = ModelsClase::findOrFail($claseId);

        // Esto obtiene SOLO los usuarios apuntados a esta clase específica
        // Y filtra correctamente para mostrar solo los que tienen rol 'cliente'
        $this->usuariosApuntados = $clase->clientes()->where('users.rol', 'cliente')->get();

        $this->dispatch('onMostrarUsuarios', ModelsClase::class);
    }



    public function closeModal()
    {
        $this->showModal = false;
    }


    //METODOS PARA BORRAR

    public function confirmarDelete(ModelsClase $clase)
    {
        // $this->authorize('delete', $clase);
        $this->dispatch('onBorrarClase', $clase->id);
    }

    #[On('borrarOk')]
    public function deleteClase($id)
    {
        $clase = ModelsClase::find($id);

        if ($clase) {
            // Verificar que el usuario logueado es el entrenador de la clase
            if (Auth::user()->id === $clase->entrenador_id) {
                $clase->delete();
                // SweetAlert de éxito
                $this->dispatch('mensaje', 'Clase eliminada con éxito.');
            }
        }
    }

    //METODOS PARA EDITAR
    public function edit(ModelsClase $clase) {
        // $this->authorize('update', $clase);
        $this->uform->setClase($clase);
        $this->abrirUpdate=true;
    }
    public function update() {
        $success = $this->uform->formUpdate();

        if ($success) {
            // Actualización exitosa
            $this->abrirUpdate = false;
            $this->dispatch('mensaje', 'Clase actualizada con éxito.');
        }
        // Si falla, no se cierra el modal y se muestra el error en el formulario
    }
    public function cancelar() {
        $this->abrirUpdate=false;
        $this->uform->formReset();
    }
}
