<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\User;
use App\Modelhasrole;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Spatie\Permission\Models\Role;



class MantenedorusuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    if($request->ajax()){ 

        $result =  User::
                leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                 ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
                 ->select(  
                        'users.id',
                        'users.name',
                        'users.iniciales',
                        'users.email',
                        'users.password',
                        'users.enabled',
                        'roles.name as roles'
                            )                                                               
                                                    
                 ->get();


            return array('data'=>$result);

        }

        return view('mantenedor.usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        try{

            $id=$request->id;
            $model=Modelhasrole::where('model_id',$id)->first();           
            
            /**
            if(isset($request->id)){
                revokePermissionTo($model);
            };
           */      


            $enabled=$request->enabled;

            if(is_null($enabled)){
                $enabled=1;
            };

            $user =User::updateOrCreate(
            ['id'=>$request->id],

            [
                'name'          => $request->name,
                'iniciales'     => $request->iniciales,    
                'email'         => $request->email,                
                'enabled'       => $enabled
         ]);

            if(is_null($model)){

                $user->assignRole($request['role']);

            }elseif(isset($request->role) && isset($model)){

                $user->removeRole($model->role_id);
                $user->assignRole($request['role']);

            }else{

                 $user->assignRole($request['role']);
            };

            



          
          /**$user->syncPermissions($request['role']); */ 

        $text = (isset($request->id)) ? 'Usuario Actualizado' : 'Usuario Agregado';    
        
        return array(
            'title' => 'Buen Trabajo',
            'text'  => $text,
            'icon'  => 'success'

        );

        } catch(Exception $e){

            return array(

                'title' => 'Error',
                'text' => $e->getCode(),
                'icon' =>'error'
            );

        };


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      


        if($request->ajax()){ 

        $result =  User::
                join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                 ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                 ->select(  
                        'users.id',
                        'users.name',
                        'users.iniciales',
                        'users.email',
                        'users.enabled',
                        'roles.name as roles'
                            )
                ->where('user.id',$id)                                                                         
                                                    
                 ->get();


            return array('data'=>$result);

        }

        return view('mantenedor.usuarios.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = user::where('id',$id)->first();

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         user::where('id', $id)->delete();


        return array(

            'title' => 'Buen Trabajo',
            'text'  => 'Registro Eliminado',
            'icon'  => 'success'

        );
    }
}
