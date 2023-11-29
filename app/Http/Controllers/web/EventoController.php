<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Evento;
use App\Models\User;
use App\Models\VinculacionCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $eventos = Evento::all();

        // return view('web.organizador.Evento.index_eventos', compact('eventos'));
        if (Auth::check()) {
            $user = Auth::user();
            // Verifica que el usuario sea de tipo 'C'
            if ($user->tipo == 'O') {
                $eventos = $user->organizador->eventos;
                return view('web.organizador.Evento.index_eventos', compact('eventos'));
            }
        }
    }


    public function invitacion($id)
    {
        $evento = Evento::find($id);
        return view('web.organizador.Evento.invitacion', compact('evento'));
    }
    public function eventoCliente($id)
    {

        if (Auth::check()) {
            $user = Auth::user();
            // Verifica que el usuario sea de tipo 'C'
            if ($user->tipo == 'O') {

                $evento = $user->organizador->eventos->where('id', $id)->first();

                return view('web.organizador.Evento.clientes_vinculados', compact('evento'));
            }
        }
        return "no está logueado";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.organizador.Evento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required|max:255',
            'gps' => 'required',
            'event_date' => 'required|date',
            'organizador_id' => 'required|integer',
            'status' => 'required|integer',
            'img_event' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // return $request;
        // Subir la imagen a S3
        if ($request->hasFile('img_event')) {
            $folder = "eventos";
            $url = Storage::disk('s3')->put($folder, $request->img_event, 'public');
        }

        // Crear el evento en la base de datos
        $evento = new Evento;
        $evento->title = $request->title;
        $evento->description = $request->description;
        $evento->address = $request->address;
        $evento->gps = $request->gps;
        $evento->event_date = $request->event_date;
        $evento->organizador_id = $request->organizador_id;
        $evento->status = $request->status;
        $evento->img_event = $url;  // URL de la imagen en S3
        $evento->save();

        return redirect()->route('evento.index')->with('toastr', ['type' => 'success', 'message' => '¡La imagen fué subida exitosamente!']);
        //return redirect()->route('evento.index')->with('success', 'Evento creado exitosamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function eventosClienteOne($id)
    {
        if (Auth::check()) {
            $user = User::find($id);

            // Verifica que el usuario sea de tipo 'C'
            if ($user->tipo == 'C') {
                $eventos = VinculacionCliente::with('Evento')->where('cliente_id', $user->id)->get();
                //return $eventos;
                return view('web.cliente.evento.index', compact('eventos'));
            }
        }
    }
    /************************CLIENTE */
    public function eventosCliente($id)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica que el usuario sea de tipo 'C'
            if ($user->type == 'C') {
                $eventos = Evento::with('VinculacionCliente')->where('id', $user->id)->get();

                return view('web.cliente.evento.index', compact('eventos'));
            }
        }
    }
}
