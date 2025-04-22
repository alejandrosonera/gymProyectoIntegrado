<?php

namespace App\Livewire;

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
            session()->flash('error', 'Ya estás apuntado a esta clase.');
            return;
        }

        // Verificar si la clase tiene espacio
        $numeroParticipantes = $clase->clientes()->count(); // Contar el número de clientes asociados
        if ($numeroParticipantes >= $clase->max_participantes) {
            session()->flash('error', 'No hay espacio disponible en esta clase.');
            return;
        }

        // Apuntar al usuario
        $clase->clientes()->attach(Auth::id());

        $this->dispatch('mensaje', 'Apuntado a la clase con éxito.');
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

        // SweetAlert de éxito
        $this->dispatch('mensaje', 'Desapuntado de la clase con éxito.');
    }



    public function verUsuariosApuntados(int $claseId)
    {
        $this->showModal = true;

        $clase = ModelsClase::findOrFail($claseId);

        // Obtener solo usuarios con rol cliente que estén apuntados
        $this->usuariosApuntados = $clase->clientes()->where('rol', 'cliente')->get();

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
}
