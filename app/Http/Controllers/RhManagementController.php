<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhManagementController extends Controller
{
    public function home()
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar esta página.');

        $colaborators = User::withTrashed()
            ->with(['details', 'department'])
            ->where('role', 'colaborator')
            ->get();

        return view('colaborators.colaborators', compact('colaborators'));
    }

    public function newColaborator()
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar esta página.');

        $departments = Department::where('id', '>', 2)->get();

        if ($departments->count() === 0) {
            abort(403, 'Não há nenhum departamento para adicionar um novo colaborador. Por favor, entre em contato com a administração para adicionar um novo departamento.');
        }

        return view('colaborators.add-colaborator', compact('departments'));
    }
}
