<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cotizacion;
use App\User;
use App\Diseno;
use App\Cliente;
use DB;
use Auth;

class AprobarclienteController extends Controller
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
             ->rightjoin('disenos', 'disenos.ventas_id', '=', 'ventas.id')             
             ->where('estados_id', 3)
             ->orwhere('estados_id', 4)
             ->orwhere('estados_id', 5)
             ->orwhere('estados_id', 6) 

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
                    'linkarchivocliente',
                    'linkarchivodisenador',                   
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

            return view('clientes.aprobarcliente');

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

            $estados_id=$request->estados_id;

            $estado_pedido = Cotizacion::where('id',$id)->first();

          
           

          if( $estado_pedido->estados_id =='3' and $estados_id =='4'){                    

                   Cotizacion::updateOrCreate(
                   ['id'=>$id],

                   [   
                       'estados_id'    => $estados_id
                   ]);
               }
            

            if( $estado_pedido->estados_id =='3' and $estados_id !=='4'){               

                return array(
                'title' => 'Antes tienes que enviar el archivo al Cliente',            
                'text'  => 'Falta enviar',
                'icon'  => 'error'
                 );

            }

            if( $estado_pedido->estados_id =='4' and $estados_id =='4'){               

                return array(
                'title' => 'Archivo ya fue enviado',            
                'text'  => 'no se puede enviar 2 veces',
                'icon'  => 'error'
                 );

            }      

           if($estado_pedido->estados_id =='4' and $estados_id =='5' ){            
   
               Cotizacion::updateOrCreate(
                   ['id'=>$id],
                
                    [   
                        'estados_id'    => $estados_id
                    ]);
                }

            if($estado_pedido->estados_id =='4' and $estados_id =='6' ){            
   
               Cotizacion::updateOrCreate(
                   ['id'=>$id],
                
                    [   
                        'estados_id'    => $estados_id
                    ]);
                }    
            
            if($estado_pedido->estados_id =='5' and $estados_id =='6' ){

                return array(
                    'title' => 'OT ACEPTADA POR CLIENTE',            
                    'text'  => 'NO SE PUEDE RECHAZAR',
                    'icon'  => 'error'
                     );

                }

            if( $estado_pedido->estados_id =='6'){

                return array(
                    'title' => 'OT RECHAZADA POR CLIENTE',            
                    'text'  => 'ESPERAR A QUE EL DISEÑADOR HAGA SU MAGIA',
                    'icon'  => 'error'
                     );

                }
            if( $estado_pedido->estados_id =='5'){

                return array(
                    'title' => 'OT YA SE ENCUENTRA APROBADA POR CLIENTE',            
                    'text'  => 'TALLER DEBE ESTAR YA TRABAJANDO',
                    'icon'  => 'error'
                     );

                }
           
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
