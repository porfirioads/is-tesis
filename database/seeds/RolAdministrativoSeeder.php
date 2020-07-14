<?php

use Illuminate\Database\Seeder;

class RolAdministrativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_administrativos')->insert([
            [
                'rol' => 'COORDINADOR',
                'usuario_id' => 1,
                'secretaria_id' => 1
            ],
            [
                'rol' => 'SECRETARIO',
                'usuario_id' => 2,
                'secretaria_id' => 1
            ],
            [
                'rol' => 'JEFE_DEPARTAMENTO',
                'usuario_id' => 3,
                'secretaria_id' => 4
            ]
        ]);
    }
}
