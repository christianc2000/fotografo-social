<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Foto;
use App\Models\Image;
use App\Models\User;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all()->sortByDesc('created_at');
        return view('web.cliente.index', compact('clientes'));
    }
    public function perfil()
    {
        return view('profile.show');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:15',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
            'number_phone' => 'required|string',
            'gender' => 'required|string|max:1',
            'birth_date' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'password' => 'required|confirmed',
        ]);
        if ($request->hasFile('photo')) {
            $folder = "perfil";
            $url = Storage::disk('s3')->put($folder, $request->photo, 'public');
            $foto = new Image([
                'url' => $url,
                'tipo' => 'P',
            ]);
            $user = User::create([
                'ci' => $request->ci,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'number_phone' => $request->number_phone,
                'tipo' => 'C',
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'password' => bcrypt($request->password)
            ]);
            $cliente = Cliente::create([
                'id' => $user->id
            ]);
            $user->images()->save($foto);
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return $request;
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
}
