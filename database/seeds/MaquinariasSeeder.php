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
                'maquina' => 'Mimaki',
            ],
             [
                'maquina' => 'Roland Blanca',
            ],
             [
                'maquina' => 'Roland Roja',
            ],
             
          

        ];


        Maquinaria::insert($data);
    }
}
