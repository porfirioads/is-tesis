<?php

use App\Models\BenBeneficiario;
use Illuminate\Database\Seeder;

class BenBeneficiarioSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'nombre' => 'Porfirio',
                'primer_apellido' => 'Díaz',
                'segundo_apellido' => 'Sánchez',
                'sexo' => 'H',
                'curp' => 'DISP960720HZSZNR15',
                'telefono' => '4949428610',
                'nombre_vialidad' => 'Donato Guerra',
                'numero_exterior' => 103,
                'numero_interior' => 0,
                'colonia' => 'Centro'
            ]
        ];

        $tableName = (new BenBeneficiario())->getTable();
        DB::table($tableName)->insert($items);
    }
}
