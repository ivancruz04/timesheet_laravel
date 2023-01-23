<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleSeeder::class);
        
        
        
        
        
        
        // // \App\Models\User::factory(10)->create();
        // $permisos = [
        //     //operaciones sobre tabla de roles
        //     'ver-rol',
        //     'crear-rol',
        //     'editar-rol',
        //     'borrar-rol',

        //     //Operaciones sobre la table de blogs

        //     'ver-blog',
        //     'crear-blog',
        //     'editar-blog',
        //     'borrar-blog'

        // ];

        // foreach($permisos as $permiso) {
        //     Permission::create(['name'=>$permsiso]);
        // }
    }
}
