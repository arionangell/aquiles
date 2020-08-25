
<template>
    <div>
        <div class="container-fluid" v-if="factura">
            <br>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Facturacion por Fecha</label>
            <input type="date" class="form-control" v-model="fecha">
            <button type="submit" class="btn btn-primary my-1" @click="facturasfecha">Buscar</button>
            <ul class="list-group" v-for="item in  this.contenido" :key="item.codigo">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{item.id+"/"+item.codigo +"-" +item.nombre+"-"+item.date_factura }}
                    <span class="  btn btn-outline-dark" @click="getFactura(item.codigo, item.date_factura,item.nombre,item.id)">up</span>
                </li>
            </ul>
        </div>




        <div class="container-fluid" v-else>
            <br>
            <br>
            <table class="table">
                <tr>
                    <th>Nº Factura</th>
                    <td>{{this.nfactura}}</td>
                    <th>Fecha</th>
                    <td>{{ this.fechafactura}}</td>
                </tr>
                <tr>
                    <th>Razon Social</th>
                    <td>{{ this.nombre }}</td>
                    <th>Nº cliente</th>
                    <td>{{ this.idnombre }}</td>
                </tr>
            </table>
            <br>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in  contenido2" :key="item.id">
                        <th scope="row">{{ item.id }}</th>
                        <td>{{ item.nombrep }}</td>
                        <td>{{ item.desc }}</td>
                        <td>{{ item.cantidad }}</td>
                        <td>{{ item.precio/item.cantidad | currency }}</td>
                        <td>{{ item.precio | currency}}</td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <td colspan="4">Firma quien recibe_____________________________Aclaracion_________________________________________________</td>
                    <th>TOTAL</th>
                    <th >{{ this.total| currency }}</th>
                </tfoot>
            </table>
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
            fecha: "",
            factura:true,
            url: 'facturas',
            contenido: [],
            contenido2: [],
            urlxfecha: 'facturabuscar',
            urlf2: 'f2',
            fechafactura: "",
            nombre:"",
            idnombre:'',
            total:0,
            nfactura:""

        }

    },

    created() {
        this.getContenido();


    },

    methods: {

        getContenido() {

            axios.get(this.url).then(Response => {
                this.contenido = Response.data
              console.log(this.contenido);
              

            });
        },

        facturasfecha() {

            axios.post(this.urlxfecha, {

                    pedido_date: this.fecha,

                })
                .then(response => {
                    this.contenido = response.data;
                   



                })
                .catch(errors => {
                    console.log(this.errors);
                });


        },

        getFactura(id_cliente, fecha,nombre,id) {
            this.fechafactura=fecha
            this.nombre=nombre
            this.idnombre=id_cliente
            this.factura=false
            this.nfactura=id
            axios.post(this.urlf2, {

                    pedido_date: fecha,
                    id_cliente: id_cliente
                })
                .then(response => {
                    this.contenido2 = response.data;
                   

                this.contenido2.forEach(element => {
                this.total= this.total+element.precio;
                this.total=Math.round(this.total * 100) / 100
});




                })
                .catch(errors => {
                    console.log(this.errors);
                });




        }

    }



}
</script>
