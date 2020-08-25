
<template>
    <div class="col-md-3">
        <div class="card card-success card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">Ingresos y Gastos</h3>
                <p class="text-muted text-center">Todos los campos son requeridos</p>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Valor</label>
                        <input type="text" class="form-control" id="validationCustom01" required v-model="valor">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Tipo</label>
                        <select class="form-control" v-model='tipo'>
                           <option disabled value="">SELECCIONAR</option>
                                    <option v-for="item in  this.contenido" :key="item.id"  v-bind:value="item.id">
                                                {{ item.name }}
                             </option>
                        </select>
                     </div>
                </div>
                <div><input type="date" class="form-control" v-model="fcartera"></div>
                <br>
                <div class="form-row">
                    <div class="col-md-12 mb-6">
                        <textarea class="form-control" v-model="comentario"></textarea>
                    </div>
                </div>
                <br>
                <a href="#" class="btn btn-primary btn-block" @click="enviar(valor,tipo,fcartera,comentario)"><b>Guardar</b></a>
            </div>


            
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
import Axios from 'axios'
export default {
   
    data() {
        return {
            contenido: [],
            url:'tipo',
            valor: 0,
            tipo:'',
            comentario:'',
            ok: [],
            fcartera:new Date().toISOString().substring(0, 10)
                }
            },

    created() {
      this.getContenido();
                },
    methods: {

        getContenido() {
            axios.get('tipo').then(Response => {
                this.contenido = Response.data                          
                                                });
                         },

        enviar(valor, tipo, fcartera, comentario) {
             this.$emit('Siguiente');
            if(valor && tipo && fcartera && comentario){
                    axios.post('caja', {
                        valor: this.valor,
                        tipo: this.tipo,
                        fcartera: this.fcartera,
                        comentario: this.comentario,
                                        }).then(response => {
                                             this.ok = response.data;
                                             this.valor=0
                                             this.tipo=""
                                             this.comentario=""
                                                               })
                                         .catch(errors => {
                                             console.log(this.errors);
                                                          });
                                                         }
            else{
                alert('Debe llenar todos los campos')
                }
                                                        }

                 }


                }   
</script>
