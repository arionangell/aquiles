<template>
    <div>
        <div v-if="factura">
                    <div class="row">
                        <VentasTotal-component :valor1="valor1"></VentasTotal-component>
                        <Otros-component :valor2="valor2"></Otros-component>
                        <Gastos-component :valor3="valor3"></Gastos-component>
                        <Rendimiento-component :valor4="valor4"></Rendimiento-component>
                    </div>
                    <div class="row">
                        <tventas-component>
                            <div slot="fechas">
                                <input type="date" name="" id="" v-model="fecha1"><input type="date" name="" id="" v-model="fecha2">
                                <br> <br>
                                <a href="#" class="btn btn-primary btn-block" @click="buscar(fecha1,fecha2)"><b>Buscar</b></a>
                                <br>
                            </div>
                        <div slot="lista1">
                            <ul class="list-group list-group-unbordered mb-3" v-for="item in  this.contenido" :key="item.id">      
                                <li class="list-group-item list-group-item-warning" v-if="item.comentario">
                                    <b @click="modelofactura(item.id, item.date_factura)" class="btn btn-success">{{ item.id }}</b> <a class="float-right">{{ item.valor |currency }}</a><b>{{ item.nombre }}</b>
                                </li>              
                                <li class="list-group-item " v-else>
                                    <b @click="modelofactura(item.id,item.date_factura)" class="btn btn-success">{{ item.id }}</b> <a class="float-right" >{{ item.valor |currency }}</a><b>{{ item.nombre }}</b>
                                </li>
                            </ul>
                        </div>
                        </tventas-component>
                        <Cartera2-component  @Siguiente="recargar"> </Cartera2-component>
                        <tCartera-component>
                            <div slot="tabla">
                                <tbody>
                                    <tr v-for="item in  contenido2" :key="item.id">
                                        <td>{{ item.id }}</td>
                                        <td> {{ item.dinero|currency }}</td>
                                        <td>{{ item.comentario }}</td>
                                        <td> {{ item.date_caja }}</td>
                                        <td> {{ item.name }}</td>
                                        <td><button @click.prevent="del(item.id)">x</button></td>
                                    </tr>
                                </tbody>
                            </div>
                        </tCartera-component>
                    </div>
        </div>
        <div v-else>
            <table class="table">
                <tr>
                    <th>Nº Factura</th>
                    <td>{{ this.id }}</td>
                    <th>Fecha</th>
                    <td>{{ this.fechafactura}}</td>
                </tr>
                <tr>
                    <th>Razon Social</th>
                    <td>{{this.usuario}}</td>
                    <td>Facturado=</td>
                    <td>{{facturado}}</td>
                    <td>recibido=</td>
                    <td>{{pagado}}</td>
                </tr>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">producto</th>
                        <th scope="col">cantidad</th>
                        <th scope="col">precio</th>      
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in caja" :key="index">
                        <th>{{item.desc}}</th>
                        <td>{{item.cantidad}}</td>
                        <td>{{item.precio |currency}}</td>
                   </tr>
                </tbody>
            </table>
            <div class="card">
                <div class="card-header">Comentario</div>
                <div class="card-body">
                    <h5 class="card-title">esto fue escrito por el repartidor</h5>
                    <p class="card-text">{{detalles}}</p>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import Axios from 'axios'
import Vue2Filters from 'vue2-filters'
    export default {
        mixins: [Vue2Filters.mixin],

        data() {


            return {
                valor1: 0,
                valor2: 0,
                valor3: 0,
                valor4: 0,
                contenido: [],
                contenido2: [],
                fecha1: "",
                fecha2: "",
                fcartera: "",
                url2: 'facturaxfecha',
                factura:true,
                contfactura:[],
                id:"",
                caja:[],
                detalles:"",
                usuario:"",
                pagado:"",
                facturado:0,
                fechafactura:""
                    }
                        },
            created() {
                this.getContenido('factura2');
                
                        },
            methods: {
                modelofactura(id,fecha){
                         this.fechafactura=fecha
                         this.id=id
                         this.factura=false    
                         axios.post('detalles', {
                             fecha: this.fechafactura,
                             id: this.id,
                                                }).then(response => {
                                                    this.caja = response.data;
                                                    this.caja.forEach(element => {
                                                                this.detalles =  element.comentario;
                                                                this.usuario=element.nombre
                                                                this.facturado=this.facturado+element.precio
                                                                this.pagado=element.valor
                                                                                 });
                                                                    })
                                           },

                getContenido(url){
                    let cont12=[]
                        axios.get(url).then(Response => {
                              cont12 = Response.data
                              this.contenido=cont12
                                cont12.forEach(element => {
                                        this.valor1 = this.valor1 + element.valor;
                                        this.valor1 = Math.round(this.valor1 * 100) / 100
                                                                    });
                                this.getContenido2(this.valor1)
                                                        });
                                                        
                                 },

                getContenido2(val1) {     
                                                                                   
                         axios.get('respt').then(Response => {
                                this.contenido2 = Response.data
                                
                                this.contenido2.forEach(element => {
                                                  if (element.name === 'INGRESO') {
                                                        this.valor2 = this.valor2 + element.dinero
                                                        
                                                                                                       
                                                                                    }
                                                  else{
                                                        this.valor3 = this.valor3 + element.dinero
                                                        
                                                       }

    this.sumar(val1,this.valor2,this.valor3);                                                      });                                                                                                                
                                                                });

                                                        
                                 },

                recargar(){
                        this.valor2=0
                        this.valor3=0
                        this.valor4=0
                    if(this.fecha1){
                           this.buscar(this.fecha1,this.fecha2)
                                    }
                    else{
                         location.reload();
                           
                        }
                          },


                buscar(fecha1, fecha2) {  
                      this.valor2=0
                        this.valor3=0
                        this.valor4=0   
                    this.valor1=0
                  
                let cont12=[]
                    
                           
                    axios.post(this.url2, {
                         fecha1: this.fecha1,
                         fecha2: this.fecha2,
                                            }).then(response => {
                                                this.contenido = response.data;
                                                this.contenido.forEach(element => {
                                                    this.valor1 = this.valor1 + element.valor;
                                                    this.tcarterafecha(this.valor1);                                                                                                                                                                                    
                                                                                  });
                                                                                   
                                                                  }).catch(errors => {
                                                                     console.log(this.errors);
                                                                                      });
                                        },

                tcarterafecha(val1){
                   let cont=[];
                    console.log(cont);
                   axios.post('cajaxfecha', {
                            fecha1: this.fecha1,
                            fecha2: this.fecha2,
                                                  }).then(resp => {
                                                        this.contenido2 = resp.data;
                                                        cont=resp.data;
                                                        this.valor2=0
                                                        this.valor3=0
                                                        this.valor4=0
                
                                                        cont.forEach(element => {
                                                            
                                                                        if (element.name === 'INGRESO') {
                                                                            this.valor2 = this.valor2 + element.dinero
                                                                            
                                                                                                          } 
                                                                        else {
                                                                            this.valor3 = this.valor3 + element.dinero
                                                                         
                                                                                }

                                                                                
                                                                                            });
                                                        this.sumar(val1,this.valor2,this.valor3);
                                                                        })
                                                    .catch(errors => {
                                                            console.log(this.errors);
                                                                        });
                    
                    
                    
                    },
                del(id) {
                     this.valor2=0
                    this.valor3=0
                    var url =  'caja/' + id;
                    axios.delete(url).then(
                                        response => {
                                            this.getContenido2();
                                            setTimeout(() => {
                                                this.resp = 'Datos eliminados';
                                                             }, 100);
                                            setTimeout(() => {
                                                this.resp = '';
                                                             }, 2000);
                                    }).catch(error => {
                                            console.log(error.response)
                                                       });
                                },

                    sumar(val1,val2,val3){
                        console.log(`el  valor 1=  ${val1} el valor 2 = ${val2}valor 3= ${val3} el valor 4= ${this.valor4}`);
                                        this.valor4 = this.valor1 + this.valor2 - this.valor3;
                                        
                    }
                }
                }
</script>
