<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'name' => 'Manuel',
            'email' => 'correo@mail.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://codigoconjuan.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('Users')->insert([
            'name' => 'Luis',
            'email' => 'correo2@mail.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://codigoconjuan.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
