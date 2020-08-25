 <div class="card">
               <form action=" /producto/{{ 'codigo' }}" method="get">
                 {{ csrf_field ()}}
                        <div class="card-header"> Producto</div>
                        <div class="card-body">
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="cod-cliente">Cod</label>
                                            <input id="codigo" class="form-control" type="text" name="codigo" v-model="codigo">
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="cliente">Nombre</label>
                                            <input id="nombrep" class="form-control" type="text" name="nombrep"   v-model="nombrep">
                                    </div>
        
                                    <div class="form-group col-md-6">
                                            <label for="empresa">Descripciòn</label>
                                            <input id="descripcion" class="form-control" type="text" name="desc"   v-model="desc">
                                    </div>
        
                                    <div class="form-group col-md-6">
                                            <label for="producto">Precio</label>
                                            <input id="precio" class="form-control" type="text" name="precio"   v-model="precio"> 
                                    </div>
        
                                    <div class="form-group col-md-6">
                                            <label for="cod-producto">Empresa</label>
                                            <input id="empresa" class="form-control" type="text" name="empresa"   v-model="empresa">
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer"><button  type="submit">Agregar</button></div>
                        </form>
         </div>