<template>
<div class="card">

               <form @submit.prevent='mostrar' >

                        <div class="card-header"> Producto</div>
                        <div class="card-body">
                            <div class="form-row">

                                    <div class="form-group col-md-6">
                                            <label for="cliente">Nombre</label>
                                            <input id="nombre" class="form-control" type="text" name="nombre"   v-model="nombrep">
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label for="empresa">Descripciòn</label>
                                            <input id="descripcion" class="form-control" type="text" name="desc"   v-model="desc">
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label for="producto">Precio</label>
                                            <input id="precio" class="form-control" type="number" step="any" name="precio"   v-model="precio">
                                    </div>


                            </div>
                        </div>
                        <div class="card-footer"><button  type="submit">Agregar</button></div>
                        </form>

                <div v-if="tiempo" class="alert alert-success" role="alert">
                         Se guardo exitosamente
                </div>
<div v-if="tiempo2" class="alert alert-danger" role="alert">
  Los campos estan incompletos
</div>

  </div>

</template>

<script>
import Axios from 'axios'
    export default {

                        data(){

                        return{
                                errors:[],
                                url:'producto',
                                ok:[],
                                nombrep:"",
                                desc:"",
                                precio:"",
                                tiempo:false,
                                tiempo2:false,
                                }
                                },
                        methods:{

                                  mostrar(){

                                             if((this.nombrep==="" )|| (this.desc==="") || (this.precio==="")){
this.tiempo2=true
 setTimeout(() => {
                                                                    this.tiempo2=false
                                                                                }, 3000);
  }

   else{
                                                        axios.post(this.url, {
                                                                nombrep:this.nombrep,
                                                                desc:this.desc,
                                                                precio:this.precio,
                                                                                         })
                                                        .then(response => {
                                                        this.ok = response.data;
                                                        this.$emit('res');
                                                              this.tiempo=true
                                                                setTimeout(() => {
                                                                    this.tiempo=false
                                                                                }, 3000);
                                                                                  
                                this.nombrep=""
                                this.desc=""
                                this.precio=""

                                                })
                                .catch(errors => {
                                                        console.log(this.errors);
                                                });

     
}
                                                }  ,





    }
    }

</script>
