<template>
<div>
        <br>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Fecha de Reparto</label>
            <input type="date" class="form-control" v-model="fecha">
            <button type="submit" class="btn btn-primary my-1" @click="facturasfecha">Buscar</button>
            <ul class="list-group" v-for="item in  this.contenido" :key="item.codigo">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{item.codigo +"-" +item.nombre+"-"+item.date_factura }}
                    <span class="  btn btn-outline-dark" @click="getFactura(item.codigo, item.date_factura,item.nombre)">up</span>
                </li>
            </ul>
</div>
</template>

<script>
import Axios from 'axios'
import Vue2Filters from 'vue2-filters'
    export default {
 mixins: [Vue2Filters.mixin],




data(){
 return {
                fecha:          "",              factura:    true,
                url:            'hoy',           contenido:  [],
                contenido2:     [],              urlxfecha:  'facturabuscar',
                urlfacturas:    'factura2',      urlf2:      'f2',
                urlf3:          'f3',            urlf5:      'f5',
                fechafactura:   "",              nombre:     "",
                idnombre:       '',              total:      0,
                validacion:     [],              id_factura: "",
                urlinsert:      'f4',            listado:    true,
                unitario:       "",              idproducto: "",
                newcantidad:    0,               newprecio:  0,
                urlup:          'pedidos',       recibe:     0,
                debe:           0,               comentario: ""
                    }
                },


  methods: {

             getContenido() {

            axios.get(this.url).then(Response => {
                this.contenido = Response.data
                                                 });
        },

          getFactura(id_cliente, fecha, nombre) {
            this.fechafactura = fecha
            this.nombre = nombre
            this.idnombre = id_cliente
            this.factura = false

            axios.post(this.urlf3, {

                    pedido_date: fecha,
                    id_cliente: id_cliente
                })
                .then(response => {
                    this.validacion = response.data;
                    
                    if (this.validacion.length === 0) {
                        this.validacion.length = 1;

                        axios.post(this.urlinsert, {

                                pedido_date: fecha,
                                id_cliente: id_cliente
                            })
                            .then(response => {
                                this.validacion = response.data;
                               
                                this.getFactura(id_cliente, fecha, nombre);

                            })
                            .catch(errors => {
                                console.log(this.errors);
                            });


                    } else {
                        this.validacion.forEach(element => {
                            this.id_factura = element.id
                        });

                    }
                })
                .catch(errors => {
                    console.log(this.errors);
                });
            this.entrega(id_cliente, fecha);


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


}

        }


</script>
