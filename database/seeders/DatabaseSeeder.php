<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminRole = Role::create(['name'=>'admin']);
        $editorRole = Role::create(['name'=>'editor']);
        $lectorRole = Role::create(['name'=>'lector']);

        Permission::create(
            ['name' => 'users.index',
             'description' => 'Ver listado',
             'for' => 'users'])->syncRoles($adminRole);

        Permission::create(
            ['name' => 'users.create',
             'description' => 'Crear',
             'for' => 'users'])->syncRoles($adminRole);

        Permission::create(
            ['name'=> 'users.edit',
             'description'=>'Editar',
             'for'=> 'users'])->syncRoles($adminRole);

        Permission::create(
            ['name'=> 'users.show',
             'description'=>'Ver',
             'for'=> 'users'])->syncRoles($adminRole);

        Permission::create(
            ['name'=> 'users.destroy',
             'description'=>'Eliminar',
             'for'=> 'users'])->syncRoles($adminRole);

             Permission::create(
                ['name' => 'roles.index',
                 'description' => 'Ver listado',
                 'for' => 'roles'])->syncRoles($adminRole);
    
            Permission::create(
                ['name' => 'roles.create',
                 'description' => 'Crear',
                 'for' => 'roles'])->syncRoles($adminRole);
    
            Permission::create(
                ['name'=> 'roles.edit',
                 'description'=>'Editar',
                 'for'=> 'roles'])->syncRoles($adminRole);
    
            Permission::create(
                ['name'=> 'roles.show',
                 'description'=>'Ver',
                 'for'=> 'roles'])->syncRoles($adminRole);
    
            Permission::create(
                ['name'=> 'roles.destroy',
                 'description'=>'Eliminar',
                 'for'=> 'roles'])->syncRoles($adminRole);
      
        Permission::create(
            ['name'=> 'posts.index',
             'description'=>'Ver listado',
             'for'=> 'posts'])
            ->syncRoles([$adminRole, $editorRole, $lectorRole]);

        Permission::create(
            ['name'=> 'posts.create',
             'description'=>'Crear',
             'for'=> 'posts'])
            ->syncRoles([$adminRole, $editorRole]);

        Permission::create(
            ['name'=> 'posts.edit',
             'description'=>'Editar',
             'for'=> 'posts'])
            ->syncRoles([$adminRole, $editorRole]);

        Permission::create(
            ['name'=> 'posts.show',
             'description'=>'Ver',
             'for'=> 'posts'])
            ->syncRoles([$adminRole, $editorRole, $lectorRole]);

        Permission::create(
            ['name'=> 'posts.destroy',
             'description'=>'Eliminar',
             'for'=> 'posts'])
            ->syncRoles([$adminRole, $editorRole]);

            

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole($adminRole);
    }
}
