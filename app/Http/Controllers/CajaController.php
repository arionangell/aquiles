<?php

namespace App\Http\Controllers;

use App\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

try {
 $fecha= date('Y-m-d');
  $pedidos= Caja::select('cajas.id', 'cajas.dinero','cajas.comentario', 'cajas.date_caja', 'tipos.name')
        ->from('cajas')
        ->join('tipos', 'cajas.tipo', 'tipos.id')
        ->where('cajas.date_caja','=',"$fecha")
        ->get();
        return $pedidos;

} catch (\Throwable $th) {
    return $th;
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
            try {


         $ins = new Caja;
         $ins-> dinero= $request->valor;
         $ins-> tipo= $request->tipo;
         $ins-> comentario= $request->comentario;
         $ins-> date_caja= $request->fcartera;

         $ins-> save();


            return $request->fcartera ;
      } catch (\Throwable $th) {
          return $th;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show(Caja $caja)
    {
        //
    }
     public function buscarxfecha(Request $request)
    {
        try {
                $fecha= date('Y-m-d');
                $fecha1=$request->fecha1;
                $fecha2=$request->fecha2;

                $caja= Caja::select('cajas.id', 'cajas.dinero','cajas.comentario', 'cajas.date_caja', 'tipos.name')
                ->from('cajas')
                ->join('tipos', 'cajas.tipo', 'tipos.id'  )
                ->whereBetween('cajas.date_caja', [$fecha1, $fecha2])
                ->get();

        return $caja;
} catch (\Throwable $th) {
    return $th;
}
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
      try {

           $note =$caja->delete();

            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
