<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cotizacion;
use App\User;
use App\Diseno;
use DB;
use Auth;


class Finalizarpedidocontroller extends Controller
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
             ->join('clientes', 'clientes.id', '=', 'ventas.clientes_id') 
             ->join('users', 'users.id', '=', 'ventas.users_id')
             ->join('disenos', 'disenos.ventas_id', '=', 'ventas.id') 
             ->where('estados_id', 11)
             //->orwhere('estados_id', 12)
             //->orwhere('estados_id',13)
                                 
             ->select(
                    'ventas.id as ventasid',
                    'ventas_id',
                    'disenos.id as disenosid',
                    'razonsocial',
                    'contacto',
                    'numero',
                    'norden',
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
                    'instalacion'
                    

             )
             
                         
             ->get();     
                
                

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);
                

            }

           return view('taller.finalizarpedido');

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
