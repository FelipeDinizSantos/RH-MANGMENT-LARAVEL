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

        $colaborators = User::with(['details'])
            ->where('role', 'rh')
            ->get();

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
            'select_department' => 'required|exists:departments,id|in:2',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|decimal:2', // força que o valor tenha 2 casas decimais
            'admission_date' => 'required|date_format:Y-m-d',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->department_id = $request->input('select_department');
        $user->permissions = ['rh'];
        $user->role = 'rh';

        $user->save();

        $user->details()->create([
            'address' => $request->input('address'),
            'zip_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'salary' => $request->input('salary'),
            'admission_date' => $request->input('admission_date'),
        ]);

        return redirect()->route('colaborators.rhUsers.index')->with('success', 'Colaborador criado com sucesso!');
    }
}
