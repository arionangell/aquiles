<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/store', function () {
try {
    if (Auth::user()->id_role==1){
        return view('store');
                                }
    if (Auth::user()->id_role==2){
        return view('reparto');
                                }
   else                         {
        return view('auth/login');
                                }
} catch (\Throwable $th) {
    return 'usted no tiene los permisos Requeridos comuniquese con el administrador';
}
   
                                     });
////////tienda hay que modificar el usuario al final

Route::get('/tienda', function () {
         try {
            if (Auth::user()->id_role==1){

      return view('tienda');
    }
         
   return view('auth/login');
         } catch (\Throwable $th) {
           return 'usted no tiene los permisos Requeridos comuniquese con el administrador';
         }

          });




 Route::get('/factura', function () {
     try {
         if (Auth::user()->id_role==1){
       return view('facturas');
                                }
    if (Auth::user()->id_role==2){
        return view('reparto');
                                }
   else                         {
        return view('auth/login');
                                }
     } catch (\Throwable $th) {
         return 'usted no tiene los permisos Requeridos comuniquese con el administrador';
     }
    
          
});
 Route::get('/reparto ', function () {
try {
    if(Auth::user()){   
    return view('reparto');
    }
   return 'usted no tiene los permisos Requeridos comuniquese con el administrador';
} catch (\Throwable $th) {
  


 
          return 'Usted no tiene permisos para esta accion';
          }
});
 Route::get('/billetera ', function () {
    if(Auth::user()){   
    return view('cartera');
      

     }
          return 'Usted no tiene permisos para esta accion';
        
});
Route::get('/board',  function () {

    return view('board');
});
Route::get('/',  function () {

    return view('auth/login');
});

Route::get('/prueba',  function () {

    return view('auth/login');
});
Route::get('/pruebas', function () {

$user=Auth::user();


return $user;






});
         


Route::get('/vendedor/producto', function(){
return view('vendedor.productos');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('clientes', 'ClienteController@index')->name('cliente');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('producto', 'ProductoController');


Route::resource('cliente', 'ClienteController');

Route::resource('empresa', 'EmpresaController');


Route::resource('pedidos', 'PedidoController');
Route::post('up','PedidoController@up');
Route::post('pcliente','PedidoController@pcomprobar');

Route::resource('shop', 'ProdVentaController');

Route::resource('facturas', 'FacturacionController');
Route::resource('factura2', 'FacturaController');

Route::resource('tipo', 'TipoController');
Route::resource('caja', 'CajaController');


Route::post('facturabuscar', 'FacturacionController@list1');
Route::post('f2', 'FacturacionController@list2');
Route::get('hoy', 'FacturacionController@index2');
Route::post('f3', 'FacturaController@comprobar');
Route::post('facturaxfecha', 'FacturaController@buscarxfecha');
Route::post('f4', 'FacturaController@store');
Route::post('f5', 'FacturacionController@update2');

Route::post('detalles', 'FacturaController@searchfactura');

Route::post('debe', 'DeudaController@verificar');
Route::post('debe2', 'DeudaController@store');


Route::get('respt', 'CajaController@index');
Route::post('cajaxfecha', 'CajaController@buscarxfecha');

Route::post('shop2', 'ProdVentaController@eliminar');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
