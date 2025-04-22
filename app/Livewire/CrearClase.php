<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearClase;
use Livewire\Component;

class CrearClase extends Component
{
    public bool $abrirCrear=false;
    public FormCrearClase $cform;

    public function render()
    {
        return view('livewire.crear-clase');
    }

    public function store() {
        $this->cform->formStore();
        $this->cancelar();
        $this->dispatch('onClaseCreada')->to(Clase::class);
        $this->dispatch('mensaje', 'Clase creada con éxito.');
    }

    public function cancelar() {
        $this->abrirCrear=false;
        $this->cform->formReset();
    }
}
