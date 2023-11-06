<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotografoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function index_imagen()
    {
        $user = Auth::user();
        $imagenes = $user->images
            ->where('tipo', 'F')
            ->sortByDesc('created_at');
        return view('web.fotografo.index-imagen', compact('imagenes'));
    }

    public function upload_imagen()
    {
        return view('web.fotografo.upload-imagen');
    }
    public function upload_imagen_store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ]);
        if ($request->hasFile('photo')) {
            $folder = "galeria_imagenes_fotografo";
            $url = Storage::disk('s3')->put($folder, $request->photo, 'public');
            $user = Auth::user();
            $foto = new Image([
                'url' => $url,
                'tipo' => 'F',
            ]);
            $user->images()->save($foto);
        }
        return redirect()->route('fotografo.imagen.index')->with('toastr', ['type' => 'success', 'message' => '¡La imagen fué subida exitosamente!']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
