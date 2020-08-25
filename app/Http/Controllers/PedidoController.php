<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $fechaActual = date('Y-m-d');

        $pedidos= Pedido::select('pedidos.id', 'empresas.siglas','productos.desc', 'clientes.nombre', 'pedidos.cantidad', 'pedidos.precio', 'productos.nombrep','pedidos.pedido_date')
        ->from('pedidos')
        ->join('empresas', 'pedidos.id_empresa', 'empresas.id')
        ->join('productos', 'pedidos.id_producto', 'productos.id')
        ->join('clientes', 'pedidos.id_cliente', 'clientes.codigo')
        ->where('pedidos.pedido_date','>=',"$fechaActual")
        ->where('pedidos.estado','=',0)
        ->orderBy('pedidos.id', 'desc')
        ->get();
        return $pedidos;

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
         
         $ins = new Pedido;
         $ins-> id_cliente= $request->id_cliente;
         $ins-> id_producto= $request->id_producto;
         $ins-> id_empresa= $request->id_empresa;
         $ins-> cantidad= $request->cantidad;
         $ins-> precio= $request->precio;
         $ins-> pedido_date= $request->pedido_date;
         $ins-> save();

$fechaActual = date('Y-m-d');

            return $fechaActual ;
     
    }







      public function pcomprobar(Request $request)
    {
try {
 
$id=$request->id_cliente;
 $factura= Pedido::select('pedidos.id', 'productos.desc', 'clientes.nombre', 'pedidos.cantidad', 'pedidos.precio', 'productos.nombrep','pedidos.pedido_date')
     ->from('pedidos')
        ->join('empresas', 'pedidos.id_empresa', 'empresas.id')
        ->join('productos', 'pedidos.id_producto', 'productos.id')
        ->join('clientes', 'pedidos.id_cliente', 'clientes.codigo')
        ->where('pedidos.id_cliente','=',$id)
        ->orderBy('pedidos.id', 'desc')
        ->get();

        return $factura;
} catch (\Throwable $th) {
    return $th;
}
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    public function up(Pedido $pedido)
    {

        $id= $pedido->idproducto;
        $cantidad= $pedido->newcantidad;
         $precio=$pedido->newprecio;


    return $cantidad;
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
           $precio= $request->precio;
           $cantidad= $request->cantidad;

try {
     $up = new Pedido;
         $up ->where('id', $pedido->id)
            ->update([

                    'cantidad' => $cantidad,
                      'precio'=> $precio,

                ]);
} catch (\Throwable $th) {
    return $th;
}


          return $precio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
       try {



           $note =$pedido->delete();

            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }


    }
}
