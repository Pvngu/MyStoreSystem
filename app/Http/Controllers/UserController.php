<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            'users' => User::filter(request(['search', 'role', 'status', 'sort_column', 'sort_order']))->paginate(20)->withQueryString(),
            'userNumbers' => User::all()
        ]);
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('user_images', 'public');
        }

        User::create($formFields);

        return redirect('/users')->with('message', 'User created successfully');
    }

    public function edit(User $user) {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
        $formFields = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'email' => 'nullable|email'
        ]);

        if($request->hasFile('image')){
            FIle::delete('storage/' . $user->image);
            $formFields['image'] = $request->file('image')->store('user_images', 'public');
        }
        else if($request->empty_image == 'yes'){
            FIle::delete('storage/' . $user->image);
            $formFields['image'] = '';
        }

        $user->update($formFields);

        return redirect('/users')->with('message', 'User updated successfully');
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