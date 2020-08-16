<?php

use App\Models\BenApoyoSecretaria;
use Illuminate\Database\Seeder;

class BenApoyoSecretariaSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'secretaria_id' => 1,
                'apoyo_id' => 1
            ],
            [
                'id' => 2,
                'secretaria_id' => 1,
                'apoyo_id' => 2
            ],
            [
                'id' => 3,
                'secretaria_id' => 1,
                'apoyo_id' => 3
            ],
            [
                'id' => 4,
                'secretaria_id' => 2,
                'apoyo_id' => 2
            ],
            [
                'id' => 5,
                'secretaria_id' => 2,
                'apoyo_id' => 3
            ],
        ];

        $tableName = (new BenApoyoSecretaria())->getTable();
        DB::table($tableName)->insert($items);
    }
}
