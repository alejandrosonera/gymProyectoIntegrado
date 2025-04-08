<?php

namespace App\Http\Controllers;

use App\Livewire\Clase;
use App\Models\User;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        $entrenadores = User::where('rol', 'entrenador')->get();
        return view('welcome', compact('entrenadores'));
    }
}
