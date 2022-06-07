<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\User;
use App\Cliente;
use App\Diseno;
use App\Taller;
use Auth;
use DB;

class PedidoController extends Controller
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
             ->leftjoin('disenos', 'disenos.ventas_id', '=', 'ventas.id')
             ->join('clientes', 'clientes.id', '=', 'clientes_id')               
             ->select(
                    'ventas.id as ventasid',
                    'ventas_id',
                    'disenos.id as disenosid',
                    'numero',
                    'norden',
                    'nombre_disenador',                    
                    'users.name',
                    'clientes_id',
                    'razonsocial',
                    'contacto',
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
             ->orderBy('ventas.id', 'asc')             
             ->get();     
                
                

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);
                

            }

            return view('pedidos.index');

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
    public function show($ventasid)
    {
        try{
            $user = Auth::user();                   
                      
             $result = Taller::join('ventas','talleres.ventas_id','=','ventas.id')             
             ->join('users', 'users.id', '=', 'talleres.users_id')
             ->join('estados', 'estados.id', '=', 'talleres.estados_id')
             ->join('disenos', 'talleres.ventas_id','=','disenos.ventas_id') 
             ->select(
                    
                    'ventas.norden', 
                    'nombre_disenador',       
                    'users.name',
                    'detalle',
                    'maquinaria',                    
                    //'DATE_FORMAT(fechamovimiento,'%d/%m/%Y')fechamovimiento'
                    //'DATE_FORMAT(fechamovimiento, '%d/%m/%Y')fechamovimiento',
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
