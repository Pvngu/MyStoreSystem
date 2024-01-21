<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            'users' => User::filter(request(['search', 'role', 'status', 'sort_column', 'sort_order']))->paginate(20)->withQueryString(),
            'userNumbers' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function create() {
        return view('users.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $role = $request->validate(['role' => 'required']);

        $formFields['password'] = bcrypt($formFields['password']);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('user_images', 'public');
        }

        $user = User::create($formFields);

        if($user){
            $user->assignRole($role);
            return redirect('/users')->with('message', 'User created successfully');
        }
        else{
            return redirect('/users')->with('erorrMessage', 'There was an error');
        }
    }

    public function edit(User $user) {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'nullable|email',
        ]);

        if(isset($request->password)) {
            $request->validate(['password' => 'nullable|confirmed|min:6']);
            $password = $request->password;
            $formFields['password'] = bcrypt($password);
        }
        
        $role = $request->validate([
            'role' => 'required'
        ]);

        if($request->hasFile('image')){
            FIle::delete('storage/' . $user->image);
            $formFields['image'] = $request->file('image')->store('user_images', 'public');
        }
        else if($request->empty_image == 'yes'){
            FIle::delete('storage/' . $user->image);
            $formFields['image'] = '';
        }

        $userUpdate = $user->update($formFields);

        if($userUpdate){
            $user->syncRoles([$role]);
            return redirect('/users')->with('message', 'User updated successfully');
        }
        else {
            return redirect('/users')->with('errorMessage', 'There was an error');
        }
    }

    public function destroy(Request $request) {
        $user = User::find($request->row_delete_id);
        if($user) {
            $destination = 'storage/' . $user->image;
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $user->delete();
            return back()->with('message', 'User deleted successfully');
        }
        else {
            return back()->with('errorMessage', 'User was not found');
        }
    }

    public function deleteUsers(Request $request){
        User::whereIn('id', $request->ids)->delete();
        return back()->with('message', 'Users deleted successfully');
    }
}