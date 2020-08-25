<template>
<div class="row">

   <div class="form-row align-items-center">
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInput">Name</label>
      <input type="text" class="form-control mb-2" placeholder="Numero de cliente" v-model="cliente" >
    </div>
        <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2" @click="getncliente">buscar</button>
    </div>
  </div>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Cliente</th>
      <th scope="col">Cantidad</th>
       <th scope="col">Precio</th>
       <th scope="col">Fecha</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="item in contenido" :key="item.id">
      <th >{{ item.id }}</th>
      <td>{{item.desc }}</td>
      <td>{{ item.nombre }}</td>
      <td>{{ item.cantidad }}</td>
       <td>{{ item.precio }}</td>
      <td>{{ item.pedido_date}}</td>
      
    </tr>
 

  </tbody>
</table>



  </div>

</template>

<script>
import Axios from 'axios'
    export default {
data() {
    return {
        contenido:[],
        cliente:"",
        url:'pcliente'

    }
},
    
    methods: {
        getncliente(){
            

                                                axios.post(this.url, {
                                                       id_cliente:this.cliente,
                                                                             })
                                .then(response => {
                                                        this.contenido = response.data;
                                                       
                                                            
                
                                                })
                                .catch(errors => {
                                                        console.log(this.errors);
                                                });             


        }
    },

    }

</script>
