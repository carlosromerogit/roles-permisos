<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return Inertia::render('Roles/Index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return Inertia::render('Roles/Create', ['permissions'=> $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> ['required', 'max:255'],
            'permissions'=> ['required', 'array', 'min:1']
        ]);

        $role = Role::create(['name'=> $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect('/dashboard/roles');
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
        //
        $role = Role::find($id);
        $permissions = Permission::all();


        return Inertia::render('Roles/Edit', [
            'role' => $role, 
            'permissions'=> $permissions, 
            'rolePermissions'=> $role->permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name'=> ['required', 'max:255'],
            'permissions'=> ['required', 'array', 'min:1']
        ]);    
        $role = Role::find($id);
        
        $role->update([
            'name'=> $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect('/dashboard/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
        $role = Role::find($id);

        $role->delete();

        return redirect('dashboard/roles');
    }
}
