<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::all();

        return view('department.departments', compact('departments'));
    }

    public function create(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        return view('department.add-department');
    }

    public function store(Request $request)
    {

        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $request->validate([
            'name' => 'required|min:3|max:50|unique:departments'
        ]);

        Department::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('department.index');
    }

    public function edit(int $id): View|RedirectResponse
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        if ((int) $id === 1) {
            return redirect()->route('department.index');
        }

        $department = Department::findOrFail($id);

        return view('department.edit-department', compact('department'));
    }

    public function update(Request $request): RedirectResponse
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!');

        $id = $request->input('id');

        if ((int) $id === 1) {
            return redirect()->route('department.index');
        }

        $request->validate([
            'name' => 'required|min:3|max:50|unique:departments,name,' . $id
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('department.index');
    }
}
