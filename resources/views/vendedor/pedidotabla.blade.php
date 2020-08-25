<div class="col-md-6">
      <table class="table table-light">
            <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Empresa</th>
                  <th>Producto</th>
                  <th>cliente</th>
                  <th>Cantidad </th>
                  <th>Precio </th>
                  <th>Fecha </th>
                </tr>
             </thead>
             <tbody>
                @foreach ($pedidos as $item)
                   <tr>
                     <td>{{$item->id}}</td>
                     <td>{{$item->siglas}}</td>
                     <td>{{$item->nombrep}}</td>
                     <td>{{$item->nombre}}</td>
                     <td>{{$item->cantidad}}</td>
                     <td>{{$item->precio}}</td>
                     <td>{{$item->pedido_date}}</td>
                   </tr>
                @endforeach
             </tbody>
             <tfoot>
                  <tr>
                     <th>#</th>
                     <th>Empresa</th>
                     <th>Producto</th>
                     <th>cliente</th>
                     <th>Cantidad </th>
                     <th>Precio </th>
                     <th>Fecha </th>
                  </tr>
             </tfoot>
        </table>
</div>

 


