<?php

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
            [
                'id' => 1,
                'username' => 'porfirioads',
                'password' => Hash::make('porfirioads'),
                'nombre' => 'Porfirio Ángel',
                'primer_apellido' => 'Díaz',
                'segundo_apellido' => 'Sánchez',
                'email' => "porfirioads@gmail.com"
            ],
            [
                'id' => 2,
                'username' => 'planeacion',
                'password' => Hash::make('$planeacion20'),
                'nombre' => 'Víctor',
                'primer_apellido' => 'Miranda',
                'segundo_apellido' => null,
                'email' => "splaneacionzac@gmail.com"
            ]
        ]);
    }
}
