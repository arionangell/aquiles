<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
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

  $factura= Factura::select('facturas.id', 'clientes.nombre', 'clientes.codigo',  'facturas.valor', 'facturas.date_factura', 'facturas.comentario')
        ->from('facturas')
        ->join('clientes','facturas.cliente_id','clientes.codigo')
        ->where('facturas.date_factura','=',"$fecha")
        ->get();
return $factura;
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
        $fecha= date('Y-m-d');
        $fecha=$request->pedido_date;
        $id=$request->id_cliente;

try {
       $ins = new Factura;
        $ins-> cliente_id= $id;
        $ins-> date_factura= $fecha;
        $ins-> save();
        return 'agregar la nota se a agregado correctamente';


      } catch (\Throwable $th) {
          return $th;
      }


    }
  public function comprobar(Request $request)
    {
try {
 $fecha= date('Y-m-d');
$fecha=$request->pedido_date;
$id=$request->id_cliente;
 $factura= Factura::select('id')
    ->where('cliente_id',$id)
    ->where('date_factura',$fecha)
    ->get();

        return $factura;
} catch (\Throwable $th) {
    return $th;
}

    }

public function searchfactura(Request $request)
    {
try {

$fecha=$request->fecha;
$id=$request->id;
 $factura= Factura::select('facturas.id', 'productos.desc', 'clientes.nombre','pedidos.cantidad','pedidos.precio','facturas.comentario', 'facturas.date_factura','facturas.valor' )
        ->from('facturas')
        ->join('pedidos', 'facturas.cliente_id', 'pedidos.id_cliente')
        ->join('clientes', 'facturas.cliente_id', 'clientes.codigo')
        ->join('productos', 'pedidos.id_producto', 'productos.id')
        ->where('facturas.id','=',"$id")
         ->where('pedidos.pedido_date','=',"$fecha")
         ->where('pedidos.deleted_at','=',null)
        ->get();

        return $factura;
} catch (\Throwable $th) {
    return $th;
}

    }



      public function buscarxfecha(Request $request)
    {
try {
 $fecha= date('Y-m-d');
$fecha1=$request->fecha1;
$fecha2=$request->fecha2;

 $factura= Factura::select('facturas.id', 'clientes.nombre', 'clientes.codigo',  'facturas.valor', 'facturas.date_factura', 'facturas.comentario')
        ->from('facturas')
        ->join('clientes', 'facturas.cliente_id','clientes.codigo'  )
        ->whereBetween('facturas.date_factura', [$fecha1, $fecha2])
        ->get();

        return $factura;
} catch (\Throwable $th) {
    return $th;
}

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
           $valor= $request->valor;
           $comentario= $request->comentario;
           $id= $request->id;

            try {
                    $up = new Factura;
                    $up ->where('id', $id)
                        ->update([

                                    'valor' => $valor,
                                    'comentario'=> $comentario,

                                ]);
            } catch (\Throwable $th) {
                                         return $th;
                                        }


          return $valor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
