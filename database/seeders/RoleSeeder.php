<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //importacion del modelo de roles
use Spatie\Permission\Models\Permission; //importacion del modelo de permisos

//vendor\spatie\laravel-permission\src\Models\Role.php

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Desarrollador']);

        //permisos para el administrador
        Permission::create(['name' => 'home'])->assignRole($role1);
        Permission::create(['name' => '/'])->assignRole($role1);

        Permission::create(['name' => 'miembros'])->assignRole($role1);
        Permission::create(['name' => 'actividades'])->assignRole($role1);
        Permission::create(['name' => 'equipos'])->assignRole($role1);
        Permission::create(['name' => 'proyectos'])->assignRole($role1);
        Permission::create(['name' => 'reportes'])->assignRole($role1);

        //Permisos para el desarrollador
        Permission::create(['name' => 'home_usuario'])->assignRole($role2);

        Permission::create(['name' => 'actividades_usuario'])->assignRole($role2);
        Permission::create(['name' => 'equipos_usuario'])->assignRole($role2);
        Permission::create(['name' => 'proyectos_usuario'])->assignRole($role2); 
    }
}
