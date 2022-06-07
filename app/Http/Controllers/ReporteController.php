<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\User;
use Auth;
use DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reportes.index');
    }


    public function bfecha (Request $request)
    {
        try{            
 
            $user = Auth::user();

            $finicio = $request->fecha_ini;
            $ffin = $request->fecha_fin;

            if($request->ajax()){             
                      
             $result = Cotizacion::join('estados','estados.id','=','ventas.estados_id')
             ->join('users', 'users.id', '=', 'ventas.users_id')
             ->join('disenos', 'disenos.ventas_id', '=', 'ventas.id')               
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
                    'fechaingreso',
                    'fechaentrega',
                    'ventas.observacion',
                    'detalle',
                    'instalacion'                 
                    

             )
            ->whereDate('ventas.fechaentrega', '>=', $finicio) 
            ->whereDate('ventas.fechaentrega', '<=', $ffin)
            
             ->orderBy('ventas.id', 'asc')             
             ->get();     
                
                

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);
                

            }

            return view('reportes.index');

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
