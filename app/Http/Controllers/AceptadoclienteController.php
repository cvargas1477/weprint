<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cotizacion;
use App\User;
use App\Diseno;
use App\Taller;
use App\Maquinaria;
use DB;
use Auth;

class AceptadoclienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{            

            $user = Auth::user();

            if($request->ajax()){             
                      
             $result = Cotizacion::join('estados','estados.id','=','ventas.estados_id')
             
             ->join('users', 'users.id', '=', 'ventas.users_id')
             ->join('disenos', 'disenos.ventas_id', '=', 'ventas.id')
             ->join('clientes', 'clientes.id', '=', 'ventas.clientes_id') 
             ->where('estados_id', 5)                                 
             ->select(
                    'ventas.id as ventasid',
                    'ventas_id',
                    'disenos.id as disenosid',
                    'numero',
                    'norden',
                    'razonsocial',
                    'contacto',
                    'nombre_disenador',                    
                    'users.name',
                    'clientes_id',
                    'tamano',
                    'cantidad',
                    'forma',
                    'terminaciones',
                    'material',                    
                    'fechaingreso',
                    'fechaentrega',
                    'ventas.observacion',
                    'detalle',
                    'linkarchivodisenador',
                    'instalacion'
                    

             )
             
                         
             ->get(); 
             

                return array('data'=>$result);
                

            }

        $result2 = Maquinaria::select('maquina')->get(); 

           return view('taller.aceptadocliente.index')->with(compact('result2'));;

        } catch(Exception $e) {


            return array(


                'title' => 'Error',
                'text' => $e->getCode(),
                'icon' =>'error'
            );

        }
    }

     public function detalle(Request $request)
    {
        try{            

            $user = Auth::user();

            if($request->ajax()){             
                      
             $result = Taller::join('ventas','ventas_id','=','ventas.id')             
             ->join('users', 'users.id', '=', 'talleres.users_id')
             ->join('estados', 'estados.id', '=', 'estados_id')             
             ->where('ventas_id', $request->ventasid)                               
             ->select(
                    
                    'norden',        
                    'users.name',
                    'detalle',
                    'maquinaria',
                    'fechamovimiento'
                                      

             )             
                         
             ->get();             

                return array('data'=>$result);                

            }      

           return view('taller.aceptadocliente.index');

        } catch(Exception $e) {


            return array(


                'title' => 'Error',
                'text' => $e->getCode(),
                'icon' =>'error'
            );

        } 


        
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

            //dd($request->estados_id);

            if(is_null($request->estados_id)){

                return array(
                'title' => 'Error',
                'text' => 'Se debe elejir un proceso',
                'icon' =>'error'
                );


            }

            $maquina = $request->maquina;


            if($request->maquina == 'Elegir maquinaria'){

                $maquina = '---';

            }

            $user = Auth::user();

            $id = $request->id;

            Taller::Create(            

            [
                'ventas_id'  => $request->id,
                'maquinaria'    => $maquina,
                'estados_id' =>$request->estados_id,
                'fechamovimiento' => now(),
                'users_id'   => $user['id'] 

         ]);          

   
            Cotizacion::updateOrCreate(
            ['id'=>$id],

            [   
                'estados_id'    => $request->estados_id
            ]);
            
            
            $text = (isset($id)) ? 'Registro Agregado ' : 'Registro Agregado';   
    
        
        return array(
            'title' => 'Buen trabajo',            
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
    public function show($ventasid)
    {
         try{
            $user = Auth::user();                   
                      
             $result = Taller::join('ventas','talleres.ventas_id','=','ventas.id')             
             ->join('users', 'users.id', '=', 'talleres.users_id')
             ->join('estados', 'estados.id', '=', 'talleres.estados_id') 
             ->select(
                    
                    'ventas.norden',        
                    'users.name',
                    'detalle',
                    'maquinaria',                    
                    //'DATE_FORMAT(created_at,'%d/%m/%Y')fechaingreso'
                    'fechamovimiento'              

             )             
              ->where('talleres.ventas_id', $ventasid)            
             ->get();             

                return array('data'=>$result);

        }catch(Exception $e){

            return array(

                'title' => 'Error',
                'text' => $e->getCode(),
                'icon' =>'error'
            );

        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Cotizacion::where('id',$id)->first();

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
         try{ 

            $user = Auth::user();


            Taller::updateOrCreate(
            ['ventas_id'=>$request->id],

            [
                'ventas_id'  => $request->id,
                'maquina'    => $request->maquina,
                'users_id'   => $user['id'] 

         ]);          

   
            Cotizacion::updateOrCreate(
            ['id'=>$id],

            [   
                'estados_id'    => $request->estados_id
            ]);
            
            
            $text = (isset($id)) ? 'Registro Agregado ' : 'Registro Agregado';   
    
        
        return array(
            'title' => 'Buen trabajo',            
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
