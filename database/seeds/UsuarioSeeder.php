<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'username' => 'porfirioads',
            'password' => Hash::make('porfirioads'),
            'nombre' => 'Porfirio Ángel',
            'primer_apellido' => 'Díaz',
            'segundo_apellido' => 'Sánchez',
            'email' => "porfirioads@gmail.com",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
