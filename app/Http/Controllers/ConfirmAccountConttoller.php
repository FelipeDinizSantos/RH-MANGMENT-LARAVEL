<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmAccountConttoller extends Controller
{
    public function confirmAccount(string $token)
    {
        echo 'Estou aqui: ' . $token;
    }
}
