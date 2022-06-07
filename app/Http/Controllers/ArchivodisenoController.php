<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cotizacion;
use App\User;
use App\Diseno;
use DB;
use Auth;

class ArchivodisenoController extends Controller
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
             ->where('estados_id', 2)
             ->orwhere('estados_id', 3)
             ->orwhere('estados_id', 6)           
             ->select(
                    'ventas.id as ventasid',
                    'ventas_id',
                    'disenos.id as disenosid',
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
                    'linkarchivocliente',                    
                    'fechaingreso',
                    'fechaentrega',
                    'ventas.observacion',
                    'detalle',
                    'linkarchivodisenador',
                    'instalacion'
                    

             )
             
                         
             ->get();     
                
                

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);
                

            }

            return view('disenos.archivodiseno');

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

          $id = $request->id;             

         $estado_pedido = Cotizacion::where('id',$id)->first();

         $estados_id = $estado_pedido->estados_id;

           

           if($estados_id == '3'){

                return array(

                'title' => 'Archivo ya se encuentra en sistema',
                'text' => 'No se pude volver a subir',
                'icon' =>'error'
                );


           }           

           Diseno::updateOrCreate(
            ['ventas_id'=>$request->id],

            [
                
                'linkarchivodisenador' => $request->linkarchivodisenador    
           
            ]);

            Cotizacion::updateOrCreate(
            ['id'=>$request->id],

            [                
                
                'estados_id'    => 3                

            ]);

                
            $text = (isset($request->ventasid)) ? 'Archivo diseñador actualizado ' : 'Archivo diseñador Agregado';   
    
        
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
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ventasid)

    {        
        
        $result = Cotizacion::where('id',$ventasid)->first();        

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
        //
    }
}
