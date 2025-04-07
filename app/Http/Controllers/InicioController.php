<?php

namespace App\Http\Controllers;

use App\Livewire\Clase;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        return view('welcome');
    }
}
