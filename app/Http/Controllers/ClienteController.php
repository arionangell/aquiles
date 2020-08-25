<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cliente= Cliente::select('id', 'codigo', 'nombre',  'direccion', 'tel', 'visita')
        ->from('clientes')
        ->orderBy('id', 'desc')
        ->get();
        return $cliente;
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
     try {
       $ins = new Cliente;
        $ins-> codigo= $request->codigo;
        $ins-> nombre= $request->nombre;
        $ins-> direccion= $request->direccion;
        $ins-> tel= $request->tel;
        $ins-> visita= $request->visita;
        $ins-> save();
        return 'agregar la nota se a agregado correctamente';


      } catch (\Throwable $th) {
          return $th;
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $codigo= $request->codigo;
        $nombre= $request->nombre;
        $direccion=$request->direccion;
        $tel=$request->tel;
        $visita=$request->visita;
try {
     $up = new Cliente;
         $up ->where('id', $cliente->id)
            ->update([

                    'codigo' => $codigo,
                    'nombre'=> $nombre,
                    'direccion'=> $direccion,
                    'tel'=> $tel,
                    'visita'=> $visita,
                ]);
} catch (\Throwable $th) {
    return $th;
}


          return $visita;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {

        try {
           $note =$cliente->delete();

            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }


    }
}
