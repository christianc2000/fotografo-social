<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Image;
use Aws\Rekognition\RekognitionClient;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class ImagenController extends BaseController
{
    public function analyze_image(Request $request, $id)
    {
        //return $request;

        $request->validate([
            'image_id' => 'required|exists:images,id'
        ]);
        //    return $this->sendResponse($request->all(),"entra y valida");
        $clientes = Cliente::all();
        $image = Image::find($request->image_id);
        $client_rekognition = new RekognitionClient([
            'region' => 'us-east-1',
            'version' => 'latest'
        ]);

        $datos = new Collection();
        $c = 0;
        foreach ($clientes as $cliente) {
            // parámetros de la comparación

            $photo_perfil = $cliente->user->images->where('tipo', 'P')->first()->url;
            // var_dump($photo_perfil);
            // var_dump($image->url);
            $params = [
                'SimilarityThreshold' => 90,
                'SourceImage' => [
                    'S3Object' => [
                        'Bucket' => env('AWS_BUCKET'),
                        'Name' => $photo_perfil,
                    ],
                ],
                'TargetImage' => [
                    'S3Object' => [
                        'Bucket' => env('AWS_BUCKET'),
                        'Name' => $image->url,
                    ],
                ],
            ];

            $result = $client_rekognition->compareFaces($params);

            if (count($result['FaceMatches']) > 0) {
                $c = $c + 1;
                $datos->push(['id' => $cliente->id, 'name' => $cliente->user->name . " " . $cliente->user->lastname]);
                //$user = Cliente::find($cliente->id);
                //$user->notify(new ClienteAparece($image));
            }
        }
        // return $this->sendResponse([$datos, $c], "clientes encontrados");
        $image->clientes = $datos;
        $image->save();
        return $this->sendResponse($image, "clientes encontrados");
    }
    // public function analizar_imagenes(Request $request, $id)
    // {

    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Reglas de validación para cada imagen en el array
    //     ]);

    //     try {
    //         if ($request->hasFile('image')) {
    //             $client = new RekognitionClient([
    //                 'region' => 'us-east-1',
    //                 'version' => 'latest'
    //             ]);
    //             // Getting the image
    //             $image = fopen($request->file('image')->getPathName(), 'r');
    //             $bytes = fread($image, $request->file('image')->getSize());
    //             $clientes = Cliente::all();
    //             // Consulting the AWS service
    //             foreach ($clientes as $cliente) {
    //                 // parámetros de la comparación
    //                 $params = [
    //                     'SimilarityThreshold' => 80,
    //                     'SourceImage' => [
    //                         'S3Object' => [
    //                             'Bucket' => env('AWS_BUCKET'),
    //                             'Name' => $cliente->foto,
    //                         ],
    //                     ],
    //                     'TargetImage' => [
    //                         'S3Object' => [
    //                             'Bucket' => env('AWS_BUCKET'),
    //                             'Name' => $image->url,
    //                         ],
    //                     ],
    //                 ];

    //                 // realizar la comparación

    //                 $result = $rekognition->compareFaces($params);
    //                 if (count($result['FaceMatches']) > 0) {
    //                     $datos->push(['id_client' => $cliente->id]);
    //                     $user = Cliente::find($cliente->id);
    //                     $user->notify(new ClienteAparece($image));
    //                 }
    //             }

    //             return $this->sendResponse($resultLabels, "imagenes analizadas");
    //         } else {
    //             return "vacio";
    //         }
    //     } catch (\Throwable $th) {
    //         return $this->sendError($th, "no conecta");
    //     }
    // }
}
