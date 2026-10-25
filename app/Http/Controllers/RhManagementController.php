<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function createColaborator(Request $request): mixed
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|decimal:2', // força que o valor tenha 2 casas decimais
            'admission_date' => 'required|date_format:Y-m-d',
        ]);

        if ($request->input('select_department') <= 2) {
            return redirect()->route('home');
        }

        $token = Str::random(64);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->department_id = $request->input('select_department');
        $user->permissions = ['colaborator'];
        $user->role = 'colaborator';
        $user->confirmation_token = $token;

        $user->save();

        $user->details()->create([
            'address' => $request->input('address'),
            'zip_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'salary' => $request->input('salary'),
            'admission_date' => $request->input('admission_date'),
        ]);

        Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirmAccount', $token)));

        return redirect()->route('rh.management.home')->with('success', 'Colaborador criado com sucesso!');
    }

    public function editColaborator(int $id)
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $colaborator = User::with('details')
            ->findOrFail($id);

        $departments = Department::where('id', '>', 2)
            ->get();

        return view('colaborators.edit-colaborator', compact('colaborator', 'departments'));
    }

    public function updateColaborator(Request $request)
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'select_department' => 'required|exists:departments,id'
        ]);

        if ($request->input('select_department') <= 2) {
            return redirect()->route('home');
        }

        $user = User::with('details')->findOrFail($request->input('user_id'));

        $user->details->salary = $request->input('salary');
        $user->details->admission_date = $request->date('admission_date');
        $user->department_id = $request->input('select_department');

        $user->save();
        $user->details->save();

        return redirect()->route('rh.management.home');
    }
}
