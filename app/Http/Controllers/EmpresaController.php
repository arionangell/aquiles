<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa= Empresa::all();
       
        return $empresa;
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
        $ins = new Empresa;
        $ins-> nombree= $request->nombree;
        $ins-> siglas= $request->siglas;
         $ins-> save();
        return 'Agregar la nota se a agregado correctamente';


      } catch (\Throwable $th) {
          return $th;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
          $nombree= $request->nombree;
          $siglas= $request->siglas;
       
try {
     $up = new Empresa;
         $up ->where('id', $empresa->id)
            ->update([
                    
                    'nombree' => $nombree,
                    'siglas'=> $siglas,
                  
                ]);
} catch (\Throwable $th) {
    return $th;
}


          return $siglas;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
         try {
           $note =$empresa->delete();
    
            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }
  
    }
}
