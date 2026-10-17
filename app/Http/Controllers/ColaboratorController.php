<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $colaborators = User::with(['details', 'department'])
            ->where('role', '!=', 'admin')
            ->get();

        return view('colaborators.admin-all-colaborators', compact('colaborators'));
    }

    public function showDetails(int $id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::with(['details', 'department'])
            ->find($id);

        return view('colaborators.show-details', compact('colaborator'));
    }

    public function deleteColaborator(int $id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::select(['id', 'name', 'email'])
            ->findOrFail($id);

        return view('colaborators.delete-colaborator-confirm', compact('colaborator'));
    }

    public function deleteColaboratorConfirm(int $id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar está página!');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);
        $colaborator->delete();

        return redirect()->route('colaborators.index');
    }
}
