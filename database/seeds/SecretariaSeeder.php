<?php

use Illuminate\Database\Seeder;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secretarias')->insert([
            [
                'id' => 1,
                'nombre' => 'SECRETARÍA DE PLANEACIÓN'
            ],
            [
                'id' => 2,
                'nombre' => 'SECRETARÍA DE GOBIERNO'
            ],
            [
                'id' => 3,
                'nombre' => 'SECRETARÍA DE SERVICIOS PÚBLICOS'
            ],
            [
                'id' => 4,
                'nombre' => 'CONTRALORÍA MUNICIPAL'
            ]
        ]);
    }
}
