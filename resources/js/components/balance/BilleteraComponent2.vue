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
               
                <div slot="lista1">
                    <ul class="list-group list-group-unbordered mb-3" v-for="item in  this.contenido" :key="item.id">
                        <li class="list-group-item list-group-item-warning" v-if="item.comentario">
                            <b @click="modelofactura(item.id)" class="btn btn-success">{{ item.id }}</b> <a class="float-right">{{ item.valor }}</a><b>{{ item.nombre }}</b>
                        </li>
                        <li class="list-group-item " v-else>
                            <b @click="modelofactura(item.id)" class="btn btn-success">{{ item.id }}</b> <a class="float-right" >{{ item.valor }}</a><b>{{ item.nombre }}</b>
                        </li>
                    </ul>
                </div>
            </tventas-component>

            <Cartera2-component    @Siguiente="recargar"> </Cartera2-component>

            <tCartera-component>
                <div slot="tabla">
                    <tbody>
                        <tr v-for="item in  contenido2" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>$ {{ item.dinero }}</td>
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
                    <td>{{  }}</td>
                    <th>Fecha</th>
                    <td>{{ this.fcartera}}</td>
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
      <td>{{item.precio}}</td>
      
    </tr>
  
  </tbody>
</table>
<div class="card">
  <div class="card-header">
  Comentario
  </div>
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
export default {

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
            facturado:0
        }
    },
    created() {
        this.getContenido('factura2');
        this.getContenido2();

    },
    methods: {
modelofactura(id){
    this.id=id
this.factura=false    
 axios.post('detalles', {

                    fecha: this.fcartera,
                    id: this.id,

                })
                .then(response => {
                    this.caja = response.data;
                   
                    this.caja.forEach(element => {
                        this.detalles =  element.comentario;
                        this.usuario=element.nombre
                        this.facturado=this.facturado+element.precio
                        this.pagado=element.valor
                    });
                    })
                    

},
        getContenido(url) {
            axios.get(url).then(Response => {
                this.contenido = Response.data
                
                this.contenido.forEach(element => {
                    this.valor1 = this.valor1 + element.valor;
                    this.valor1 = Math.round(this.valor1 * 100) / 100
                    
                });





            });
        },

        getContenido2() {
            this.valor2 = 0;
            this.valor3 = 0;
            axios.get('respt').then(Response => {
                this.contenido2 = Response.data
                
                this.contenido2.forEach(element => {
                    if (element.name === 'INGRESO') {
                        this.valor2 = this.valor2 + element.dinero
                      this.valor2 =   Math.round(this.valor2 * 100) / 100
                    } else {
                        this.valor3 = this.valor3 + element.dinero
                        this.valor3= Math.round(this.valor3 * 100) / 100
                    }
                });
                this.valor4 = this.valor1 + this.valor2 - this.valor3
                this.valor4=Math.round(this.valor4 * 100) / 100
            });
        },

recargar(){

if(this.fecha1){
this.buscar(this.fecha1,this.fecha2)
}
else{
this.getContenido2();
}
},
        buscar(fecha1, fecha2) {
            this.valor1 = 0
            this.valor2 = 0;
            this.valor3 = 0;
            this.valor4 = 0
            axios.post(this.url2, {

                    fecha1: this.fecha1,
                    fecha2: this.fecha2,

                })
                .then(response => {
                    this.contenido = response.data;
                    
                    this.contenido.forEach(element => {
                        this.valor1 = this.valor1 + element.valor;
                        this.valor1=Math.round(this.valor1 * 100) / 100
                    });


                })
                .catch(errors => {
                    console.log(this.errors);
                });



            axios.post('cajaxfecha', {

                    fecha1: this.fecha1,
                    fecha2: this.fecha2,

                })
                .then(response => {

                    this.contenido2 = response.data;
                   
                    this.contenido2.forEach(element => {
                        if (element.name === 'INGRESO') {
                            this.valor2 = this.valor2 + element.dinero
                        } else {
                            this.valor3 = this.valor3 + element.dinero
                        }
                    });

                    this.valor4 = this.valor1 + this.valor2 - this.valor3

                })
                .catch(errors => {
                    console.log(this.errors);
                });



        },
          del(id) {
            var url =  'caja' + id;
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

    }

}
</script>
