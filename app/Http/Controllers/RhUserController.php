<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RhUserController extends Controller
{
    public function index(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $colaborators = User::where('role', 'rh')->get();

        return view('colaborators.rh-users', compact('colaborators'));
    }

    public function newColaborator()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $departments = Department::all();

        return view('colaborators.add-rh-user', compact('departments'));
    }

    public function createColaborator(Request $request): RedirectResponse
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'select_departments' => 'required|exists:departments,id'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->department_id = $request->input('select_department');
        $user->permissions = ['rh'];
        $user->role = 'rh';

        $user->save();

        return redirect()->route('colaborators.rhUsers.index')->with('success', 'Colaborador criado com sucesso!');
    }
}
