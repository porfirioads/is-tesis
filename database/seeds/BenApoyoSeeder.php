<?php

use App\Models\BenApoyo;
use Illuminate\Database\Seeder;

class BenApoyoSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'nombre' => 'DESPENSA'
            ],
            [
                'id' => 2,
                'nombre' => 'CEMENTO'
            ],
            [
                'id' => 3,
                'nombre' => 'BOILER SOLAR'
            ]
        ];

        $tableName = (new BenApoyo())->getTable();
        DB::table($tableName)->insert($items);
    }
}
