<?php

namespace App\Livewire;

use App\Models\Clase as ModelsClase;
use Livewire\Component;

class Clase extends Component
{
    public function render()
    {
        $clases=ModelsClase::with('entrenador')
        ->orderBy('nombre')
        ->get();
        return view('livewire.clase', compact('clases'));
    }
}
