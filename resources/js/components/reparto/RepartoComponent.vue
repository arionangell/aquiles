<template>
    <div>
        <div class="container-fluid" v-if="factura">
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
        <div class="container-fluid" v-else>
            <br>
            <br>
            <table class="table">
                <tr>
                    <th>Nº Factura</th>
                    <td>{{ id_factura }}</td>
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
            <div v-if="listado">
                <ul class="list-group" v-for="item in  this.contenido2" :key="item.id">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{item.id+ ' / ' +item.nombrep+' '+item.desc + ' / ' + item.cantidad + ' / $ ' + item.precio }}
                        <span class="btn btn-outline-dark" @click="editar(item.id, item.cantidad, item.precio)"><i class="nav-icon fa fa-edit"></i></span>
                        <span class="btn btn-outline-dark" @click="eliminar(item.id, item.cantidad, item.precio)" >x</span>

                    </li>
                </ul>
                <br><br>

                <div class="row">
                    <div class="col form-group">
                        <label>Total</label>
                        <input type="number" class="form-control" disabled v-model="total">

                    </div>

                    <div class="col form-group">
                        <label>Recibe</label>
                        <input type="number" class="form-control" v-model="recibe">
                    </div>
                </div>
                <div class='row'>
                    <div class="col form-group">
                        <label>Debe</label>
                        <input type="number" class="form-control" v-model="debe" disabled>
                    </div>
                    <div class="col form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" v-model='comentario'></textarea>
                    </div>
                </div>
                <div class='row'>
                    <div class="col form-group">
                        <button @click="getRepartidor(recibe,debe,comentario)">Guardar</button>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="number" class="form-control mb-2" id="inlineFormInput" disabled v-model="idproducto" hidden>
                        <input type="number" class="form-control mb-2" id="inlineFormInput" disabled v-model="unitario">
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control mb-2" id="inlineFormInput" placeholder="cantidad" v-model="newcantidad" >
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control mb-2" id="inlineFormInput" placeholder="precio" disabled v-model="newprecio">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-primary mb-2" @click="update(idproducto,newcantidad,newprecio)">Cargar</button>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-danger mb-2" @click="atras()">Atras</button>
                    </div>
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

        created() {
                this.getContenido();
                    },


        watch: {
        // cuando 'question' cambie, se ejecutará esta función
            newcantidad: function(newQuestion) {
                if (this.newcantidad > 0) {
                    return this.newprecio = this.unitario * this.newcantidad;
                                            }
                                                },

        recibe: function(newQuestion) {
            if (this.recibe) {
                    return this.debe = this.total - this.recibe;
                            }
                                        }
                },

        methods: {

             getContenido() {

            axios.get(this.url).then(Response => {
                this.contenido = Response.data
                                                 });
        },

            
           getRepartidor(recibe,debe,comentario){

                axios.put(this.urlfacturas + '/' + this.id_factura, {
                    valor: recibe,
                    comentario: comentario,
                    id: this.id_factura
                                                                    })
                                            .then(response => {
                                                 this.ok = response.data;
                                                                })
                                            .catch(errors => {
                                                console.log(this.errors);
                                                                });

                if(debe===0){
                    this.update2(this.fechafactura,this.idnombre,0, 'facturas');
                            }
                 else{
                    this.update2(this.fechafactura,this.idnombre,0, 'facturas');
                    this.verificar1(this.id_factura,"debe",this.debe)
                        }
                this.factura=true;
                this.recibe=0
                this.total=0
                this.debe=0
                this.comentario=""
                this.getContenido()
                                                        },

           update2(dato1,dato2,dato3,url){
                axios.put(url + '/' + dato2, {
                    id_cliente: dato2,
                    fecha: dato1,
                                               })
                            .then(response => {
                                this.ok = response.data;
                                               })
                            .catch(errors => {
                                console.log(this.errors);
                                            });
                                            },



                
            verificar1(id,url,debe){
                axios.post(url, {
                    id: id,
                                })
                        .then(response => {
                            this.ok = response.data;
                            var n=this.ok.length
                            console.log(n);
                            if(n>0){
// actualizar Deuda


                                    }
                            else{
// insertar Deuda
                                this.insdeuda(debe,id,'debe2')
                                    }


                                            })
                        .catch(errors => {
                            console.log(this.errors);
                                            });
                                    },
            insdeuda(dato1,dato2,dato3){
                axios.post(dato3, {
                    debe: dato1,
                    id: dato2
                                    })
                                        .then(response => {
                                            this.ok = response.data;
                alert(this.ok)

                })
                .catch(errors => {
                    console.log(this.errors);
                });


},





        update(idproducto, newcantidad, newprecio) {
            axios.put(this.urlup + '/' + idproducto, {
                    cantidad: newcantidad,
                    precio: newprecio,
                })
                .then(response => {
                    this.ok = response.data;
                    alert('El precio fue actualizado')
                this.newprecio=0
                this.newcantidad=0

                })
                .catch(errors => {
                    console.log(this.errors);
                });

            this.listado = true;
            this.entrega(this.idnombre, this.fechafactura);
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


        entrega(id_cliente, fecha) {

            axios.post(this.urlf2, {

                    pedido_date: fecha,
                    id_cliente: id_cliente
                })
                .then(response => {
                    this.contenido2 = response.data;
                    

                    this.contenido2.forEach(element => {
                        this.total = this.total + element.precio;
                        this.total= Math.round(this.total * 100) / 100
                    });
                })
                .catch(errors => {
                    console.log(this.errors);
                });

        },

        editar(id, cantidad, precio) {
            this.listado = false;
            this.unitario = precio / cantidad
            this.idproducto = id
            this.total=0

        },
              atras() {
            this.listado = true;
           

        },
        eliminar(id,cantidad,precio,idnombre,fecha){

                axios.post(this.urlf5 , {
                    precio: precio,
                    cantidad: cantidad,
                    id:id
                                        }).then(response => {
                                            this.ok = response.data;
                                                            })
                                          .catch(errors =>  {
                                            console.log(this.errors);
                                                            });
                    this.total=0
                    this.entrega(this.idnombre,this.fechafactura);
                                                        },
    }

}
</script>
