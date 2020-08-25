<template>
<div class="row">

    <div class="card col-12">
   <div class="card-header"> Productos para Venta</div>
                        <div class="card-body">
                            <div class="form-row">
                                   <div class="form-group col-md-4">
                                            <label for="cliente">Marca</label>
                                            <input id="marca" class="form-control"  type="text" name="nombrep"   v-model="marca">
                                    </div>
                                            <div class="form-group col-md-4">
                                            <label for="empresa">Producto</label>
                                            <input id="producto" class="form-control" type="text" name="desc"   v-model="producto">
                                    </div> <div class="form-group col-md-4">
                                            <label for="empresa">Detalle</label>
                                            <input id="detalle" class="form-control" type="text" name="desc"   v-model="detalle">
                                    </div>
                                     <div class="form-group col-md-4">
                                            <label for="empresa">Link</label>
                                            <input id="link" class="form-control" type="text" name="desc"   v-model="link">
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer"><button  @click="cargar(marca,producto,detalle,link),$emit('Siguiente')">Agregar</button></div>
    </div>
</div>
</template>

<script>
import Axios from 'axios'

export default {
        data(){

                return{
                                marca:'',
                                producto:'',
                                detalle:'',
                                link:''
                }

                },
        methods:{


                cargar(marca,producto,detalle,link){
                                                        
                                                        axios.post('shop', {
                                                                        marca:this.marca,
                                                                        producto:this.producto,
                                                                        detalle:this.detalle,
                                                                        link:this.link,
                                                                        })
                                                                        .then(response => {
                                                                        this.ok = response.data;
                                                                       
                                                                        this.marca=""
                                                                        this.producto=""
                                                                        this.detalle=""
                                                                        this.link=""


                                                                         })
                                                                        .catch(errors => {
                                                                        console.log(this.errors);
                                                                                        });

                                                                         
                                                                }
              }

              


}
</script>
