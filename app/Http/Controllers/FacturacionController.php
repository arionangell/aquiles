<?php

namespace App\Http\Controllers;
use App\Pedido;
use App\Factura;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $fechaActual = date('Y-m-d');
        $mañana = date("Y-m-d",strtotime($fechaActual."+ 1 days"));


        $pedidos= Factura::select('facturas.id', 'clientes.codigo', 'clientes.nombre', 'facturas.date_factura')
        ->from('facturas')
        ->join('clientes', 'facturas.cliente_id', 'clientes.codigo')
        ->where('facturas.date_factura','=',"$mañana")

        ->get();
        return $pedidos;

    }
 public function index2()
    {  
        $fechaActual = date('Y-m-d');



        $pedidos= Factura::select('facturas.id', 'clientes.codigo', 'clientes.nombre', 'facturas.date_factura')
        ->from('facturas')
        ->join('clientes', 'facturas.cliente_id', 'clientes.codigo')
        ->where('facturas.date_factura','=',"$fechaActual")
        ->where('facturas.valor','=',0)
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
        //
    }


     public function list1(Request $request)
    {
$fecha= date('Y-m-d');
$fecha=$request->pedido_date;



 $pedidos= Factura::select('facturas.id', 'clientes.codigo', 'clientes.nombre', 'facturas.date_factura')
       ->from('facturas')
        ->join('clientes', 'facturas.cliente_id', 'clientes.codigo')
        ->where('facturas.date_factura','=',"$fecha")
        ->get();
         return $pedidos;
    }


      public function hoy(Request $request)
    {
  $fecha= date('Y-m-d');
$fecha=$request->pedido_date;



 $pedidos= Pedido::selectRaw(' DISTINCT pedidos.id_cliente, clientes.nombre, pedidos.pedido_date')
        ->from('pedidos')
        ->join('clientes', 'pedidos.id_cliente', 'clientes.codigo')
        ->where('pedidos.pedido_date','=',"$fecha")

        ->get();
         return $pedidos;
    }






     public function list2(Request $request)
    {
$fecha= date('Y-m-d');
$fecha=$request->pedido_date;
$id=$request->id_cliente;
$pedidos= Pedido::select('pedidos.id','productos.nombrep','productos.desc','pedidos.cantidad', 'pedidos.precio')
        ->from('pedidos')
        ->join('productos', 'pedidos.id_producto', 'productos.id')
        ->where('pedidos.pedido_date','=',"$fecha")
        ->where('pedidos.id_cliente','=',"$id")
         ->get();


         return $pedidos;
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
           $fecha= $request->fecha;
           $id_cliente= $request->id_cliente;
           $id= $request->id;

            try {
                    $up = new Pedido;
                    $up ->where('id_cliente', $id_cliente)
                        ->where('pedido_date', $fecha)
                        ->update([

                                    'estado' => 1,


                                ]);
            } catch (\Throwable $th) {
                                         return $th;
                                        }


          return $fecha;
    }


    public function update2(Request $request)
    {

            $id= $request->id;
           $cantidad= $request->cantidad;
           $precio= $request->precio;

            try {
                    $up = new Pedido;
                    $up ->where('id', $id)
                        ->update([

                                    'cantidad' => 0,
                                     'precio' => 0,


                                ]);
            } catch (\Throwable $th) {
                                         return $th;
                                        }


          return $id;
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
