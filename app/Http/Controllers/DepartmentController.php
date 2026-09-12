<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar está página!'); 

        $departments = Department::all();

        return view('department.departments', compact('departments'));
    }
}
