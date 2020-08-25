@extends('maestro')
@section('contenido')
     <div id="app">

@if(Auth::user()->id_role==1)
 <cartera-component></cartera-component>

 @else

<cartera3-component></cartera2-component>

@endif

  </div>

@endsection




