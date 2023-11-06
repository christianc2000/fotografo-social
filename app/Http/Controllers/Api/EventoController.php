<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends BaseController
{
    public function update_status_event(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);
        try {
            $evento = Evento::findOrFail($id);
            $evento->status = $request->status;
            $evento->save();
            return $this->sendResponse($evento, 'success');
        } catch (\Throwable $th) {
            return $this->sendError($th, 'error');
        }
    }
}
