<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home() 
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        return view('home');
    }
}
