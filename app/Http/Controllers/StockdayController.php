<?php

namespace App\Http\Controllers;

use App\stockday;
use Illuminate\Http\Request;

class StockdayController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\stockday  $stockday
     * @return \Illuminate\Http\Response
     */
    public function show(stockday $stockday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\stockday  $stockday
     * @return \Illuminate\Http\Response
     */
    public function edit(stockday $stockday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\stockday  $stockday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stockday $stockday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\stockday  $stockday
     * @return \Illuminate\Http\Response
     */
    public function destroy(stockday $stockday)
    {
        try {



            $note = $stockday->delete();

            return "Los datos se han eliminado";
        } catch (\Throwable $th) {
            return $th;
        }

    }
}
