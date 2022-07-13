<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cotizacion;
use App\Cliente;
use App\User;
use App\Estados;
use DB;
use Auth;



class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//   public function index(Request $request)

    


    public function index(Request $request)
    {
       try{            

            $user = Auth::user();

            if($request->ajax()){             
                      
            $result = Cotizacion::join('clientes', 'clientes.id', '=', 'clientes_id')
            ->select(

                'id',
                'numero',
                'norden',
                'razonsocial',
                'contacto',
                'users_id',
                'clientes_id',
                'tamano',
                'cantidad',
                'forma',
                'terminaciones',
                'material',                    
                //'DATE_FORMAT(fechaingreso,'%d/%m/%Y')fechaingreso',
                //'DATE_FORMAT(fechaentrega,'%d/%m/%Y')fechaentrega',
                'fechaingreso',
                'fechaentrega',
                'observacion',
                'estados_id',
                'instalacion'                    

                )->get();                
                

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);
                

            }

            return view('cotizaciones.index');

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
        //si viene para actualizar la orden realizar esta accion, de lo contrario pase al siguiente nivel
           if(isset($request->id)) {
            if($request->estados_id >= 6){

                return array(
                    'title' => 'No se puede EDITAR',            
                    'text'  => 'Pedido se encuentra en Taller o Finalizado',
                    'icon'  => 'error'
                     );


            };

                $norden = $request->norden;

                Cotizacion::updateOrCreate(

                    ['id'=>$request->id],

                    [                        
                        
                        'norden'                => $request->norden,
                        'ncotizacion'           => $request->ncotizacion,
                        'linkcotizacion'        => $request->linkcotizacion,
                        'clientes_id'           => $request->clientes_id,
                        'tamano'                => $request->tamano,
                        'cantidad'              => $request->cantidad,
                        'forma'                 => $request->forma,
                        'terminaciones'         => $request->terminaciones,
                        'material'              => $request->material,
                        'linkarchivocliente'    => $request->linkarchivocliente,
                        'fechaingreso'          => $request->fechaingreso,
                        'fechaentrega'          => $request->fechaentrega,
                        'observacion'           => $request->observacion,                
                        'estados_id'            => $request->estados_id,
                        'instalacion'           => $request->instalacion

                    ]);
                    
                    
                    $text = (isset($request->id)) ? 'Orden de trabajo actualizado' : 'Orden de trabajo agregado';   
            
                
                    return array(
                    'title' => 'N° Orden'.' '.$norden,            
                    'text'  => $text,
                    'icon'  => 'success'
                     );

            };


            $numero=0;
            $ano=2022;
            $user = Auth::user();

            //obtener ultimo número de cotización
            $numero = Cotizacion::select('numero')->orderby('numero','desc')->first();

            //si no existe ningun registro, se asigna 0, para comenzar con 1
            if( $numero == NULL ){
                $numero['numero'] = 0;
            }

            //incrementar el numero
           $numero = $numero['numero']+1;

           //asignar el numero de orden juntando el numero + 1 y el año
           $norden = $numero.'-'.$ano;
           $users_id = $user['id'];
           

        try{       

           Cotizacion::updateOrCreate(
            ['id'=>$request->id],

            [
                'numero'                => $numero,
                'norden'                => $norden,
                'ncotizacion'           => $request->ncotizacion,
                'linkcotizacion'        => $request->linkcotizacion,
                'users_id'              => $users_id,
                'clientes_id'           => $request->clientes_id,
                'tamano'                => $request->tamano,
                'cantidad'              => $request->cantidad,
                'forma'                 => $request->forma,
                'terminaciones'         => $request->terminaciones,
                'material'              => $request->material,
                'linkarchivocliente'    => $request->linkarchivocliente,
                'fechaingreso'          => $request->fechaingreso,
                'fechaentrega'          => $request->fechaentrega,
                'observacion'           => $request->observacion,                
                'estados_id'            => 1,
                'instalacion'           => $request->instalacion

            ]);
            
            
            $text = (isset($request->id)) ? 'Orden de trabajo actualizado' : 'Orden de trabajo agregado';   
    
        
        return array(
            'title' => 'N° Orden'.' '.$norden,            
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
    public function show(Request $request,$id)
    {       
            $user = Auth::user();
            if( $request->ajax() ){  

               $result = Cotizacion::join('estados','estados.id','=','ventas.estados_id')
               ->join('users', 'users.id', '=', 'ventas.users_id')
               ->join('clientes', 'clientes.id', '=', 'ventas.clientes_id')
               ->select(
                    'ventas.id',
                    'numero',
                    'ncotizacion',
                    'linkcotizacion',
                    'norden',
                    'razonsocial',
                    'contacto',
                    'name',
                    'clientes_id',
                    'tamano',
                    'cantidad',
                    'forma',
                    'terminaciones',
                    'linkarchivocliente',
                    'material',                    
                    'fechaingreso',
                    'fechaentrega',
                    'ventas.observacion',
                    'detalle',
                    'instalacion'
                    

             )
             ->where('clientes_id',$id)
             ->get();               

                return ['data'=>$result];
            }
            $cliente = Cliente::where('id',$id)->get();
            return view('cotizaciones.index',compact('cliente','id'));
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


    public function detalle(Request $request,$id,$numero){
        dd( $id .'-'.$numero );
    }

}
