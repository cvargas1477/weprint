<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DB;
use Auth;

class ClienteController extends Controller
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

            $result = Cliente::select(DB::raw("

                    id,
                    rut,
                    razonsocial,
                    contacto,
                    celular,
                    email,
                    direccion,
                    DATE_FORMAT(created_at,'%d/%m/%Y')fecha_creacion,
                    observacion

                "))->get();

             // DATE_FORMAT(start_date, '%d%m%Y')start_date   ...para dar forma a las fecha, esto se pone en la parte interna del $result//

                return array('data'=>$result);

            }

            return view('clientes.index');

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

            Cliente::updateOrCreate(
            ['id'=>$request->id],

            [
                'rut'               => $request->rut,
                'razonsocial'       => $request->razonsocial,    
                'contacto'          => $request->contacto,
                'celular'           => $request->celular,
                'direccion'         => $request->direccion,
                'email'             => $request->email,
                'observacion'       => $request->observacion,
                'users_id'          => $user->id


         ]);

        $text = (isset($request->id)) ? 'Cliente actualizado' : 'Cliente agregado';    
        
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
        $result = Cliente::where('id',$id)->first();

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

        Cliente::where('id', $id)->delete();


        return array(

            'title' => 'Buen Trabajo',
            'text'  => 'Registro Eliminado',
            'icon'  => 'success'

        );


    }
}
