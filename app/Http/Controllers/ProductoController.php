<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos= Producto::select('id','nombrep','desc','precio')
        ->from('productos')
        ->orderBy('id', 'desc')
        ->get();
        return $productos;
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
    public function store(Request $request){
 
      try {
       $ins = new Producto;
        $ins-> nombrep= $request->nombrep;
        $ins-> desc= $request->desc;
        $ins-> precio= $request->precio;
        $ins-> save();
        return 'agregar la nota se a agregado correctamente';


      } catch (\Throwable $th) {
          return $th;
      }

      


    


    
}        





    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
           $precio= $request->precio;
           $nombrep= $request->nombrep;
           $desc=$request->desc;
try {
     $up = new Producto;
         $up ->where('id', $producto->id)
            ->update([
                    
                    'nombrep' => $nombrep,
                    'desc'=> $desc,
                    'precio'=> $precio,
                
                ]);
} catch (\Throwable $th) {
    return $th;
}


          return $desc;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        try {
           $note =$producto->delete();
    
            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }
  
    }
}
