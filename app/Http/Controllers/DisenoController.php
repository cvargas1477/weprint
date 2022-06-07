<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\Cliente;
use App\User;
use App\Estados;
use App\Diseno;
use App\Modelhasrole;
use DB;
use Auth;

class DisenoController extends Controller
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
             ->where('estados_id', 1)             
             ->orwhere('estados_id', 6)             
             ->select(
                    'ventas.id as ventasid',
                    'ventas_id',
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
                    'fechaingreso',
                    'fechaentrega',
                    'ventas.observacion',
                    'detalle',
                    'instalacion'
                    

             )
                         
             ->get();    

                return array('data'=>$result);
                

            } 

            $result2 = User::role('disenador')->get();
     

            return view('disenos.index')->with(compact('result2'));


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

            $user = Auth::user(); 


            if($request->nombre_disenador == "Elegir diseñador"){

                return array(

                'title' => 'Error',
                'text' => 'No eligió ningun diseñador',
                'icon' =>'error'
            );

            }  

            diseno::updateOrCreate(
            ['ventas_id'=>$request->id],

            [
                'ventas_id'         => $request->id,
                'nombre_disenador'  => $request->nombre_disenador
                

         ]);

            Cotizacion::updateOrCreate(
            ['id'=>$request->id],
            [
                'estados_id'          => 2

             ]);

        $text = (isset($request->id)) ? 'Diseñador agregado' : 'Diseñador actualizado';    
        
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
    public function show(Request $request)
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
