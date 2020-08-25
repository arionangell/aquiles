@extends('maestro')
@section('contenido')
        <div class="row" id="app">
              @include('vendedor.pedido')
              @include('vendedor.pedidotabla',$pedidos)
              
        </div>
        <div class="row">
             @include('vendedor.clientes')
             @include('vendedor.clientetabla')
        <div class="row">
             @include('vendedor.productos')
             @include('vendedor.productotabla')
        </div>
        <div class="row">
             @include('vendedor.empresa')
             @include('vendedor.empresatabla')
        </div>
@endsection



      

 

  


















