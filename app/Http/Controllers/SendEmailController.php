<?php

namespace App\Http\Controllers;

use App\Mail\InviteMail;
use App\Models\Evento;
use App\Models\VinculacionCliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendEmailController extends Controller
{
    // public function index()
    // {

    //     $details = [
    //         'title' => 'Invitación de Laravel',
    //         'body' => 'Esta es tu invitación...'
    //     ];

    //     Mail::to('tu_correo@example.com')->send(new InviteMail($details));

    //     return "Correo enviado";
    // }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'evento' => 'required'
        ]);

        $details = [
            'title' => 'Invitación de Laravel',
            'body' => 'Esta es tu invitación...'
        ];

        try {
            Mail::to($request->email)->send(new InviteMail($details, $request->evento));
            return "Correo enviado";
        } catch (\Exception $e) {
            // Aquí puedes manejar la excepción como quieras
            // Por ejemplo, puedes retornar el mensaje de la excepción
            return "Error al enviar el correo: " . $e->getMessage();
        }
    }

    public function acceptInvitation($id)
    {

        if (Auth::check()) {
            $user = Auth::user();

            // Verifica que el usuario sea de tipo 'C'
            if ($user->tipo == 'C') {

                $evento = Evento::find($id);
                return view('email.accept_invitacion', compact('evento'));
            } else {
                //  return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
                return "No es un cliente";
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function storeAccept($id, Request $request)
    {
        // Asegúrate de que el usuario esté autenticado
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica que el usuario sea de tipo 'C'
            if ($user->tipo == 'C') {
                if ($request->accept === "si") {
                    //entonces se registra al cliente como vinculado al evento
                    $vinculacion = VinculacionCliente::create([
                        'accept_date' => now(),
                        'evento_id' => $id,
                        'cliente_id' => $user->id
                    ]);
                    $information=["vinculacion" => VinculacionCliente::find($vinculacion->id), "usuario" => $user];
                    $qrCode = QrCode::format('png')->size(400)->generate(json_encode($information));
                    //  return $qrCode;
                    $fechaHoraActual = Carbon::now()->format('YmdHis');
                    $name = 'qr_' . $user->name . '_' . $fechaHoraActual . '.png';
                    $folder = 'qr';
                    $path = $folder . '/' . $name;
                    $store = Storage::disk('s3')->put($path, $qrCode, 'public');

                    if ($store) {
                        $url = Storage::disk('s3')->url($path);
                        $vinculacion->qr_assistance = $url;
                        $vinculacion->save();
                    }
                    // $folder = "qr";
                    // $url = Storage::disk('s3')->put($folder, $qrCode, 'public');
                    $vinculacion->qr_assistance = $url;
                    $vinculacion->save();
                    return redirect()->route('evento.cliente.one', $user->id); //retorna a los eventos que tiene el cliente que aceptó
                } else {
                    //entonces no se vincula el cliente al evento

                }
            } else {
                return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
            }
        } else {
            return redirect('login');
        }
    }
}
