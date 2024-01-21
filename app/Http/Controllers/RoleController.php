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

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create($formFields);
        
        $permissions = $request->ids;

        $role->givePermissionTo($permissions);

        return redirect('users/roles')->with('message', 'Role was created successfully');
    }

    public function edit(Request $request, Role $role) {
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function update (Request $request, Role $role) {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $role->update($formFields);

        $permissions = $request->ids;

        $role->syncPermissions($permissions);

        return redirect('users/roles')->with('message', 'Role was updated successfully');
    }

    public function destroy(Request $request) {
        $role = Role::find($request->row_delete_id);
        if($role) {
            $role->delete();
            return redirect('users/roles')->with('message', 'Role was deleted successfully');
        }
        else {
            return redirect('users/roles')->with('errorMessage', 'There was an error');
        }
    }

    public function deleteRoles(Request $request){
        Role::whereIn('id', $request->ids)->delete();
        return back()->with('message', 'Roles deleted successfully');
    }
}
