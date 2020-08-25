<template>
<div class="card">

               <form @submit.prevent='mostrar' >

                        <div class="card-header"> Clientes</div>
                        <div class="card-body">
                            <div class="form-row">

                                    <div class="form-group col-md-6">
                                            <label for="cliente">Codigo</label>
                                            <input id="codigo" class="form-control" type="text" name="codigo"   v-model="codigo"  required>
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label for="empresa">Nombre</label>
                                            <input id="nombrea" class="form-control" type="text" name="nombrea"   v-model="nombre" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label for="producto">direccion</label>
                                            <input id="direccion" class="form-control" type="text" name="direccion"   v-model="direccion" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="producto">tel</label>
                                            <input id="tel" class="form-control" type="number" name="tel"   v-model="tel" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="producto">Visita</label>
                                            <input id="visita" class="form-control" type="tex" name="visita"   v-model="visita" required>
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
                                url:'cliente',
                                ok:[],
                                nombre:this.nombre,
                                codigo:this.codigo,
                                direccion:this.direccion,
                                tel:this.tel,
                                visita:this.visita,
                                tiempo:false,
                                tiempo2:false,
                                }
                                },
                        methods:{

                                  mostrar(){
                                                axios.post(this.url, {
                               nombre:this.nombre,
                                codigo:this.codigo,
                                direccion:this.direccion,
                                tel:this.tel,
                                visita:this.visita
                                                                        })
                                .then(response => {
                                                        this.ok = response.data;
                                                      this.tiempo=true
                                                      this.$emit('res');
    setTimeout(() => {
        this.tiempo=false
    }, 3000);


                                this.nombre=""
                                this.codigo=""
                                this.direccion=""
                                this.tel=""
                                this.visita=""

                                                })
                                .catch(errors => {
                                                        this.tiempo2=true
    setTimeout(() => {
        this.tiempo2=false
    }, 3000);
                                                });

     this.$emit('res');

                                                }  ,





    }
    }

</script>
