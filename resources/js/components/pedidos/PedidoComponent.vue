
<template>
    <div class="card">
        <div class="card-header">
            PEDIDOS
        </div>
        <div class="card-body">
            <div class="form-row">

                <div class="form-group col-md-6" v-if="lista">
                    <label for="cod-cliente">Cod Cliente</label>

                    <input id="cod1" class="form-control" type="text" name="id_cliente" v-model="id_cliente" @click="cliente" hidden>
                    <input type="text" class="form-control" v-model="search" @change="filtrardatos">
                    <ul class="list-group" v-for="item in  filtrardatos" :key="item.id">
                        <li class="list-group-item dropdown " data-toggle="list" @click="selecionar1(item.nombre,item.codigo)">
                            {{ item.nombre+'-'+item.codigo }}</li>
                    </ul>

                </div>
                <div class="form-group col-md-6" v-else>
                    <label for="cod-cliente">Cod Cliente</label>

                    <input id="cod1" class="form-control" type="text" name="id_cliente" v-model="id_cliente" @click="cliente" required>
                </div>

                <div class="form-group col-md-6" v-if="lista3">
                    <label for="cod-producto">cod producto</label>
                    <input id="codproducto1" class="form-control" type="text" name="id_producto" v-model="id_producto" @click="productos" hidden>
                    <input type="text" class="form-control" v-model="search" @change="filtrardatos">
                    <ul class="list-group" v-for="item in  filtrardatos" :key="item.id">
                        <li class="list-group-item dropdown " @click="selecionar3(item.desc,item.precio,item.id)">
                            {{ item.id+' - '+ item.nombrep+' '+item.desc +' - '+item.precio}}</li>
                    </ul>
                </div>
                <div class="form-group col-md-6" v-else>
                    <label for="cod-producto">cod producto</label>
                    <input id="codproducto1" class="form-control" type="text" name="id_producto" v-model="id_producto" @click="productos"  required>
                </div>

                <div class="form-group col-md-6">
                    <label for="cliente" hidden>Cliente</label>
                    <input id="cliente1" class="form-control" type="text" name="cliente1" v-model="nombre" required hidden>
                </div>

               <!--  <div class="form-group col-md-6" v-if="lista2">


                    <label for="empresa" hidden>Empresa</label>
                    <input id="empresa1" class="form-control" type="text" name="id_empresa" v-model="id_empresa" @click="empresas" hidden>
                    <input type="text" class="form-control" v-model="search" @change="filtrardatos" hidden>
                    <ul class="list-group" v-for="item in  filtrardatos" :key="item.id" hidden>
                        <li class="list-group-item dropdown " @click="selecionar2(item.nombree,item.siglas,item.id)" hidden>
                            {{ item.id+' - '+item.siglas +' - '+item.nombree}}</li>
                    </ul>

                </div>
                <div class="form-group col-md-6" v-else>
                    <label for="empresa">Empresa</label>
                    <input id="empresa1" class="form-control" type="text" name="id_empresa" v-model="id_empresa" @click="empresas" required>
                </div> -->

                <div class="form-group col-md-6">
                    <label for="producto" hidden>Producto</label>
                    <input id="producto1" class="form-control" type="text" name="producto1" v-model="producto" required hidden>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad1" class="form-control" type="text" name="cantidad" v-model.number="cantidad" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha Entrega</label>
                    <input id="fecha1" class="form-control" type="date" name="pedido_date" v-model="pedido_date" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="number" v-model.number="valor" disabled>
                    <input id="fecha1" class="form-control" type="number" name="fecha1" placeholder="%" v-model.number="porcentaje" required>
                    <input id="fecha1" class="form-control" type="number" name="fecha1" placeholder="precio" v-model="precio" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button @click="mostrar">Agregar</button>
        </div>
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

    data() {

        return {
            errors: [],
            url: 'pedidos',
            ok: [],
            nombre: "",
            id_cliente: "",
            id_empresa: this.id_empresa,
            id_producto: this.id_producto,
            cantidad: this.cantidad,
            pedido_date: this.pedido_date,
            precio: "",
            producto: "",
            contenido: [],
            search: "",
            urlclientes: 'cliente',
            urlempresa: 'empresa',
            urlproductos: 'producto',
            tiempo:false,
            tiempo2:false,
            lista: false,
            lista2: false,
            lista3: false,
            valor: 0,
            porcentaje: this.procentaje,
            urlf3: 'f3',
            urlinsert: 'f4'
        }
    },
    watch: {
        // cuando 'question' cambie, se ejecutará esta función
        porcentaje: function(newQuestion) {
            if (this.valor > 0) {
                var por = this.valor * this.porcentaje / 100;
                this.precio = (por + this.valor) * this.cantidad;
                return this.precio= Math.round(this.precio * 100) / 100
            }
        },
        cantidad: function(newQuestion) {
            if (this.valor > 0) {
                var por = this.valor * this.porcentaje / 100;
                this.precio = (por + this.valor) * this.cantidad;
                return this.precio= Math.round(this.precio * 100) / 100
            }
        }
    },


    methods: {


        mostrar() {
            axios.post(this.url, {
                    id_cliente: this.id_cliente,
                    id_empresa: 2,
                    id_producto: this.id_producto,
                    cantidad: this.cantidad,
                    pedido_date: this.pedido_date,
                    precio: this.precio
                })
                .then(response => {
                    this.ok = response.data;
                   
                    this.agregrafactura(this.id_cliente, this.pedido_date)
                    this.$emit('res');
                    this.cantidad=0;
                    this.procentaje=0;
                })
                .catch(errors => {
                   this.tiempo2=true
    setTimeout(() => {
        this.tiempo2=false
    }, 3000);
                });

            this.$emit('res');

        },

        agregrafactura(id_cliente, pedido_date) {


            axios.post(this.urlf3, {

                    pedido_date: this.pedido_date,
                    id_cliente: this.id_cliente
                })
                .then(response => {
                    this.validacion = response.data;
                    console.log(this.validacion);
                    if (this.validacion.length === 0) {


                        axios.post(this.urlinsert, {

                                pedido_date: this.pedido_date,
                                id_cliente: this.id_cliente
                            })
                            .then(response => {
                                this.validacion = response.data;
                                console.log(this.validacion);
                                console.log("la factura fue generada existosamente");


                            })
                            .catch(errors => {
                                console.log(this.errors);
                            });


                    } else {
                        console.log('la factura ya fue generada');


                    }
                })
                .catch(errors => {
                    console.log(this.errors);
                });


         
           this.tiempo=true
    setTimeout(() => {
        this.tiempo=false
    }, 3000);
        },





        
        cliente() {
            this.search = ""
            this.contenido = []
            if (!this.list) {
                this.lista = true
                axios.get(this.urlclientes).then(Response => {
                    this.contenido = Response.data

                    return this.contenido
                });
            } else {

                this.list = false
            }


        },
        empresas() {
            this.search = ""
            this.contenido = []
            if (!this.list2) {
                this.lista2 = true
                axios.get(this.urlempresa).then(Response => {
                    this.contenido = Response.data

                    return this.contenido
                });
            } else {

                this.list2 = false
            }


        },
        productos() {
            this.search = ""
            this.contenido = []
            if (!this.list3) {
                this.lista3 = true
                axios.get(this.urlproductos).then(Response => {
                    this.contenido = Response.data

                    return this.contenido
                });
            } else {

                this.lista3 = false
            }


        },
        selecionar1(nombre, id) {

            this.nombre = nombre;
            this.id_cliente = id;
            this.lista = false;



        },
        selecionar2(nombre, sigla, id) {


            this.id_empresa = id;
            this.lista2 = false;



        },
        selecionar3(desc, precio, id) {


            this.id_producto = id;
            this.producto = desc;
            this.valor = precio;
            this.lista3 = false;



        },
        calculadora() {
            if (this.valor > 0) {
                var por = this.valor * this.porcentaje / 100;
                return this.precio = por + this.valor;
            }
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
              
 return contenido
                    }


    }
}
</script>
