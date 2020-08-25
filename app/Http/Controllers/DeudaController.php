<?php

namespace App\Http\Controllers;

use App\deuda;
use Illuminate\Http\Request;

class DeudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $debe=$request->debe;
        $id=$request->id;
         try {
         $ins = new deuda;
         $ins-> id_factura= $id;
         $ins-> deuda= $debe;
         $ins-> save();

            return $debe ;
      } catch (\Throwable $th) {
          return $th;
      }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function show(deuda $deuda)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function edit(deuda $deuda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deuda $deuda)
    {
        //
    }
   public function verificar(Request $request)
    {
            $id= $request->id;

try {

 $factura= deuda::select('id')
    ->where('id_factura',$id)

    ->get();

        return $factura;
} catch (\Throwable $th) {
    return $th;
}




         return $id;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(deuda $deuda)
    {
        //
    }
}
