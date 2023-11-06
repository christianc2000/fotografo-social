<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Image;
use App\Models\User;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseController
{
    public function perfil(Request $request, $id)
    {
        $request->validate([
            'ci' => 'required|exists:users',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
            'number_phone' => 'required|string',
            'gender' => 'required|string|max:1',
            'birth_date' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240' // Permitir que la foto sea nula
        ]);

        $user = User::findOrFail($id);

        // Actualizar campos excepto la foto
        $user->update([
            'ci' => $request->ci,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);

        // Si se proporcionó una foto, guardarla en S3 y actualizar el campo 'photo'
        if ($request->hasFile('photo')) {

            $folder = "perfil";
            $url = Storage::disk('s3')->put($folder, $request->photo, 'public');
            if (count($user->images) == 0) {
                $foto = new Image([
                    'url' => $url,
                    'tipo' => 'P',
                ]);
                $user->images()->save($foto);
            } else {
                $oldImageUrl = $user->images->first()->url;
                Storage::disk('s3')->delete($oldImageUrl);
                $user->images->first()->update([
                    'url' => $url,
                ]);
            }
        }

        return $this->sendResponse([$user, $user->images->where('tipo', 'P')->first()], 'Success');
    }

    public function password_update(Request $request, $id)
    {
        $request->validate([
            'before_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::findOrFail($id);

        $passwordMatches = Hash::check($request->before_password, $user->password);
        if ($passwordMatches) {
            // La contraseña es correcta
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->sendResponse($passwordMatches, 'Success');
        } else {
            // La contraseña es incorrecta
            return $this->sendError($passwordMatches, 'fail');
        }
    }

    public function detect_one_face(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240' // Permitir que la foto sea nula
        ]);

        $client_rekognition = new RekognitionClient([
            'region' => 'us-east-1',
            'version' => 'latest'
        ]);
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');

            // Verificar si la carga de la imagen fue exitosa
            if ($uploadedFile->isValid()) {
                $imageData = file_get_contents($uploadedFile->path());
                $detect_image = $client_rekognition->detectFaces([
                    'Image' => [
                        'Bytes' => $imageData,
                    ],
                ]);
               
                if (count($detect_image['FaceDetails']) > 0) {
                    // Si se detectaron caras, la carga es válida
                    return $this->sendResponse($detect_image['FaceDetails'], 'Success');
                }else{
                    return $this->sendError('No hay rostros detectados', []);
                }
            } else {
                return $this->sendError('file no valido', []);
            }
        } else {
            return $this->sendError('no es un file', []);
        }
    }
}
