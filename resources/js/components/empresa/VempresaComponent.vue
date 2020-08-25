<template>
<div class="card" >

               <form @submit.prevent='mostrar' >
                        <div class="card-header"> Empresa</div>
                        <div class="card-body">
                            <div class="form-row">
                                   <div class="form-group col-md-6">
                                            <label for="cliente">Empresa</label>
                                            <input id="nombree" class="form-control"  type="text" name="nombree"   v-model="nombree">
                                    </div>
                                            <div class="form-group col-md-6">
                                            <label for="empresa">Siglas</label>
                                            <input id="siglas" class="form-control" type="text" name="siglas"   v-model="siglas">
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
                                url:'empresa',
                                ok:[],
                                nombree:this.nombree,
                                siglas:this.siglas,
                                tiempo:false,
                                tiempo2:false,
                                }
                                },
                        methods:{

                                  mostrar(){
                                                axios.post(this.url, {
                               nombree:this.nombree,
                                siglas:this.siglas,
                                                                      })
                                .then(response => {
                                                        this.ok = response.data;
                                                         this.tiempo=true
                                                         this.$emit('res');
    setTimeout(() => {
        this.tiempo=false
    }, 3000);

                                this.nombree=""
                                this.siglas=""
                                                })
                                .catch(errors => {
                                                      setTimeout(() => {
        this.tiempo2=false
    }, 3000);
                                                });

     this.$emit('res');

                                                }  ,





    }
    }

</script>
