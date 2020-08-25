<?php

namespace App\Http\Controllers;

use App\prod_venta;
use Illuminate\Http\Request;

class ProdVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $prod= prod_venta::all();
       
        return $prod;
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
                $ins = new prod_venta;
                $ins-> marca=      $request->marca;
                $ins-> producto=   $request->producto;
                $ins-> detalle=    $request->detalle;
                $ins-> link=       $request->link;
                $ins-> save();

                $fechaActual = date('Y-m-d');

            return $fechaActual ;
      } catch (\Throwable $th) {
          return $th;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\prod_venta  $prod_venta
     * @return \Illuminate\Http\Response
     */
    public function show(prod_venta $prod_venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\prod_venta  $prod_venta
     * @return \Illuminate\Http\Response
     */
    public function edit(prod_venta $prod_venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\prod_venta  $prod_venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prod_venta $prod_venta)
    {
        //
    }

    public function eliminar(Request $request)
    {
    $del = prod_venta::find($request->id);

            $del->delete();
        return 'funciona';
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\prod_venta  $prod_venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(prod_venta $prod_venta)
    {
         try {

           $note =$prod_venta->delete();
            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
