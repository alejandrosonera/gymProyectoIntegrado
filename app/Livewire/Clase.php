<?php

namespace App\Livewire;

use App\Models\Clase as ModelsClase;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use function Laravel\Prompts\alert;

class Clase extends Component
{
    use WithPagination;

    public bool $showModal=false;


    public string $buscar = "";
    public $usuariosApuntados = []; // Para almacenar los usuarios apuntados


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
        $this->showModal=true;

        // Obtener la clase con los usuarios apuntados
        $clase = ModelsClase::findOrFail($claseId);

        // Obtener los usuarios apuntados a esta clase
        $this->usuariosApuntados = $clase->clientes; // Aquí asumimos que tienes una relación 'clientes' definida en el modelo de la clase

        // Mostrar un modal o sección con los usuarios
        $this->dispatch('onMostrarUsuarios', ModelsClase::class); // Esto emite un evento para abrir un modal o actualizar la vista
    }

    public function closeModal() {
        $this->showModal = false;
    }


    public function deleteClase($id)
    {
        $clase = Clase::find($id);

        if ($clase) {
            // Verificar que el usuario logueado es el entrenador de la clase
            if (Auth::user()->id === $clase->entrenador_id) {
                $clase->delete();
                session()->flash('message', 'Clase eliminada con éxito');
            } else {
                session()->flash('error', 'No tienes permiso para eliminar esta clase');
            }
        }
    }
}
