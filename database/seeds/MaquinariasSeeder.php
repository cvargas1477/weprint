<?php

use Illuminate\Database\Seeder;
use App\Maquinaria;

class MaquinariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data = [
            [
                'maquina' => 'Impresora blanca',
            ],
             [
                'maquina' => 'Impresora negra',
            ],
             [
                'maquina' => 'Impresora roja',
            ],
             
          

        ];


        Maquinaria::insert($data);
    }
}
