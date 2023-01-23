<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BienvenidoController extends Controller
{
    
    public function index(){
        return view('inicio.bienvenido');
    }
}
