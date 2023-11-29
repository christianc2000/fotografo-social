<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Image;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $imagenes = Image::where('tipo', 'F')->get();
        $eventos = Evento::all();
        return view('welcome', compact('imagenes','eventos'));
    }
}
