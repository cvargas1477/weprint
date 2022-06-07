<?php
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_administrador = factory(User::class)->create([
            'name' => 'Cristian Vargas',
            'iniciales' => 'CVA',
            'email' => 'cvargas@weprint.com',
            'password' => Hash::make('14188259Cva'),      


        ]);

        $user_administrador->assignRole('administrador');
             
        
        //$user_vendedor = factory(User::class)->create([
          //  'name' => 'Vendedor',
          //  'iniciales' => 'VVV',
          //  'email' => 'vendedor@weprint.cl',
          //  'password' => '12345678', 

        //]);
         //$user_disenador = factory(User::class)->create([
           // 'name' => 'Diseñador',
           // 'iniciales' => 'DDD',
           // 'email' => 'disenador@weprint.cl',
           // 'password' => '12345678', 

        //]);
         // $user_taller = factory(User::class)->create([
          //  'name' => 'Taller',
          //  'iniciales' => 'TTT',
          //  'email' => 'taller@weprint.cl',
          //  'password' => '12345678', 

        //]);
         // $user_supervisor = factory(User::class)->create([
           // 'name' => 'Supervisor',
           // 'iniciales' => 'SSS',
           // 'email' => 'supervisor@weprint.cl',
           // 'password' => '12345678', 

        //]);
         

        
        //factory(User::class, 7)->create();

        
        //$user_vendedor->assignRole('vendedor');
        //$user_disenador->assignRole('disenador');
        //$user_taller->assignRole('taller');
        //$user_supervisor->assignRole('supervisor');


    }
}
