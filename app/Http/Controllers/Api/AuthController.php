<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        // start validatons
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255,email',
            'password' => 'required|min:8',
        ]);
        $validator->setCustomMessages([
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser un correo electronico',
            'password.required' => 'La contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->sendError('Validation Error.', ['email' => 'Correo electrónico no registrado.']);
            }
            return $this->sendError('Unauthorized', ['password' => 'La contraseña es errónea']);
        }
        // end validations

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        $result = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ];

        return $this->sendResponse($result, 'You have successfully log in');
    }
}
