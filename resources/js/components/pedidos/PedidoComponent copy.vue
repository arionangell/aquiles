
<template>
     <div class="card">
                     <div class="card-header">
                                                 PEDIDOS
                     </div>
                     <div class="card-body">
                            <div class="form-row">
                                   <div class="form-group col-md-6" v-if="lista">
                                                                      <label for="cod-cliente">Cod Cliente</label>
                                                                    
                                                                      <input id="cod1" class="form-control" type="text" name="id_cliente"   v-model="id_cliente" @click="cliente" hidden >
                                                                      <input type="text" class="form-control" v-model="search" @change="filtrardatos">
                                                                      <ul class="list-group" v-for="item in  this.contenido" :key="item.id" >
                                                                      <li class="list-group-item" @click="selecionar1(item.nombre,item.codigo)">{{ item.nombre+'-'+item.codigo }}</li>
                                                                      </ul>
                                  
                                   </div>
                                   <div class="form-group col-md-6" v-else>
                                                                      <label for="cod-cliente">Cod Cliente</label>
                                                                    
                                                                      <input id="cod1" class="form-control" type="text" name="id_cliente"   v-model="id_cliente" @click="cliente"  >
                                                                      
                                                                    
                                  
                                   </div>
                                   <div class="form-group col-md-6">
                                                                      <label for="cliente">Cliente</label>
                                                                      <input id="cliente1" class="form-control" type="text" name="cliente1" v-model="nombre">
                                   </div>
        
                                   <div class="form-group col-md-6">
                                                                      <label for="empresa">Empresa</label>
                                                                      <input id="empresa1" class="form-control" type="text" name="id_empresa"   v-model="id_empresa">
                                   </div>
        
                                   <div class="form-group col-md-6">
                                                                      <label for="producto">Producto</label>
                                                                      <input id="producto1" class="form-control" type="text" name="producto1">
                                   </div>
        
                                   <div class="form-group col-md-6">
                                                                      <label for="cod-producto">cod producto</label>
                                                                      <input id="codproducto1" class="form-control" type="text" name="id_producto"   v-model="id_producto">
                                   </div>
        
                                   <div class="form-group col-md-6">
                                                                      <label for="cantidad">Cantidad</label>
                                                                      <input id="cantidad1" class="form-control" type="text" name="cantidad"   v-model="cantidad">
                                   </div>
        
                                   <div class="form-group col-md-6">
                                                                      <label for="fecha">Fecha Entrega</label>
                                                                      <input id="fecha1" class="form-control" type="date" name="pedido_date"   v-model="pedido_date">
                                   </div> 
                                   <div class="form-group col-md-6">
                                                                      <label for="fecha">5000</label>
                                                                      <input id="fecha1" class="form-control" type="number" name="fecha1" placeholder="%">
                                                                      <input id="fecha1" class="form-control" type="number" name="fecha1" placeholder="div">
                                                                      <input id="fecha1" class="form-control" type="number" name="fecha1" placeholder="precio"    v-model="precio">
                                                                      
                                   </div> 
                            </div>
                     </div>
                     <div class="card-footer">
                                                  <button  @click="mostrar">Agregar</button>
                     </div>

</div>
</template>

<script>
import Axios from 'axios'

    export default {
                       
                        data(){
                  
                        return{
                                errors:[],
                                url:"pedidos",
                                ok:[],
                                nombre:"",
                                id_cliente:"",
                                id_empresa:this.id_empresa,
                                id_producto:this.id_producto,
                                cantidad:this.cantidad,
                                pedido_date:this.pedido_date,
                                precio:this.precio,
                                contenido:[],
                                search:"",
                                urlclientes:"cliente",
                                lista:false
                                }
                                },
                       
                       
                       methods:{

                   
                                  mostrar(){
                                                axios.post(this.url, {
                                                       id_cliente:this.id_cliente,
                                                       id_empresa:this.id_empresa,
                                                       id_producto:this.id_producto,
                                                       cantidad:this.cantidad,
                                                       pedido_date:this.pedido_date,
                                                       precio:this.precio          
                                                                        })
                                .then(response => {
                                                        this.ok = response.data;
                                                        alert(this.ok)
        
                
                                                })
                                .catch(errors => {
                                                        console.log(this.errors);
                                                });              
                     
     this.$emit('res');
                                                    
                                                }  ,
                                                cliente(){
                                                       this.lista=true
axios.get(this.urlclientes).then(Response => {
                this.contenido = Response.data
                
return this.contenido
            });


                                        
                                                },
                                                selecionar1(nombre,id){
                                                      
                                                       this.nombre=nombre;
                                                       this.id_cliente=id;
                                                         this.lista=false;



                                                }
     
  
    },
     computed: {
         filtrardatos() {
             
            let contenido = this.contenido;
            if (this.search) {
                contenido = contenido.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
             if(this.contenido=contenido){

 return this.contenido=contenido;
            }
        }
        
       }
        }
  
        
</script>
