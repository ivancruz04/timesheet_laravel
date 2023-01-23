<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ivan cruz',
            'email' => 'ivancruz@discom.com',
            'password' => Hash::make('12345678'),
            'id_puesto' => 1
        ])->assignRole('Admin');
    }
}
