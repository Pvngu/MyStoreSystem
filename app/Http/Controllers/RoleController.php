<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return view('roles.index', [
            'roles' => Role::paginate(20)
        ]);
    }

    public function create() {
        return view('roles.create');
    }
}
