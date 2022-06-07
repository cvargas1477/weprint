<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_administrador = Role::create(['name' => 'administrador']);
        $role_vendedor = Role::create(['name' => 'vendedor']);
        $role_disenador = Role::create(['name' => 'disenador']);
        $role_taller = Role::create(['name' => 'taller']);
        $role_supervisor = Role::create(['name' => 'supervisor']);

        $permissions = collect([
            'create servise',
            'save service',
            'edit servise',
            'see servise',
            'can delete servise',
            'update servise',
            'can register servise',            
            'register user',
            'disable user',
            'edit all user',
            'register client',
            'delete client',
            'edit client',            
            'edit all client',
            'assign desing',
            'change state',
            'report',
        ]);


       $permissions_by_role = [

        'vendedor' => [
          'create servise',
          'save service',
          'see servise',
          'register client',
          'edit client',  
            

        ],

        'disenador'=>[
            
            'see servise',
            'update servise',

            
        ],

        'taller'=>[
            'update servise',
            'see servise',
            

        ],

        'supervisor'=>[
            'create servise',
            'save service',
            'edit servise',
            'see servise',
            'can delete servise',
            'update servise',
            'register user',
            'delete client',
            'edit client',
            'edit all client',
            'assign desing',
            'change state',
            'report',
          


        ],

        'administrador'=>[
            'create servise',
            'save service',
            'edit servise',
            'see servise',
            'can delete servise',
            'register user',
            'disable user',
            'edit all user',
            'delete client',
            'edit client',
            'edit all client',
            'assign desing',
            'change state',
            'report',
          

        ],
       


       ]; 

       $permissions = $permissions->map(function($permission){

        return ['name' => $permission, 'guard_name' => 'web'];
       });

       Permission::insert($permissions->toArray());

       $role_administrador->syncPermissions($permissions_by_role['administrador']);
       $role_vendedor->syncPermissions($permissions_by_role['vendedor']);
       $role_disenador->syncPermissions($permissions_by_role['disenador']);
       $role_taller->syncPermissions($permissions_by_role['taller']);
       $role_supervisor->syncPermissions($permissions_by_role['supervisor']);


    }
}
