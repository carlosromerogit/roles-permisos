<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return Inertia::render('Usuarios/Index', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        return Inertia::render('Usuarios/Create', ['roles'=> $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>['required', 'max:255'],
            'email'=>['required', 'max:255', 'email', 'unique:users,email'],
            'password'=>['required', 'max:255', 'confirmed', Password::default()],
            'password_confirmation'=> ['required', 'max:255'],
            'role'=> ['required']
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        $user->roles()->attach($request->role);

        return redirect('dashboard/usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return Inertia::render('Usuarios/Edit', ['user'=> $user, 'role'=> $user->roles, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'email'=>['required', 'max:255', 'email'],
            'password'=>['required', 'max:255', 'confirmed', Password::default()],
            'password_confirmation'=> ['required', 'max:255']
        ]);

        $user = User::find($id);

        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        $user->roles()->sync($request->role);

        return redirect('dashboard/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $user->delete();

        return redirect('dashboard/usuarios');
    }
}
