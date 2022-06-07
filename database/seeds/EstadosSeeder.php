<?php

use Illuminate\Database\Seeder;
use App\Estados;

class EstadosSeeder extends Seeder
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
                'estado' => 'VENTAS',
                'detalle' => 'Asignar a diseñador',
            ],
            [
                'estado' => 'DISEÑO',
                'detalle' => 'Diseñador trabajando',
            ],
            [
                'estado' => 'VENTAS',
                'detalle' => 'Diseño terminado, enviar a Cliente',
            ],
            [
                'estado' => 'VENTAS',
                'detalle' => 'Enviado a Cliente',
            ],
            [
                'estado' => 'VENTAS',
                'detalle' => 'Aceptado por Cliente',
            ],
            [
                'estado' => 'VENTAS',
                'detalle' => 'Rechazado por Cliente',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'En Impresión',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'En Corte',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'En laminado',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'Terminación manual',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'Listo para entrega',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'Finalizado/Entregado',
            ],
            [
                'estado' => 'TALLER',
                'detalle' => 'Finalizado/Instalado',
            ],

        ];


        Estados::insert($data);


    }
}
