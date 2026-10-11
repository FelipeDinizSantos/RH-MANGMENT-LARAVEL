<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmAccountConttoller extends Controller
{
    public function confirmAccount(string $token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            abort(403, 'Token de validação inválido!');
        }

        return view('auth.confirm-account', compact('user'));
    }

    public function confirmAccountSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required|string|size:64',
            'password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/',
        ]);

        $user = User::where('confirmation_token', $request->input('token'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return view('auth.welcome', compact('user'));
    }
}
