<template>
<div  class="row">
        <div class="col-12 col-sm-6 ">
                    <pedidocomponent @res='this.reset'></pedidocomponent>
        </div>

    <div class="col-12 col-sm-6">
        <buscador :titulo="titulo">
                <div slot="paginacion">
                     <select id="inputState" class="form-control" v-model="selected" @change="resetPagination()">
                            <option v-for="item in opcions" :key="item.cantidad">{{ item.cantidad }}</option>
                     </select>
                </div>
        <input type="text" class="form control" v-model="search">
    </buscador>

    <estructura :colhead="colhead">
        <tbody >

            <tr v-for="item in  paginated" :key="item.id">
                 <td>{{ item.id }}</td>

                 <td>{{ item.nombrep }}</td>

                <td>{{item.desc }}</td>

                <td>{{ item.nombre }}</td>

                <td>{{ item.cantidad }}</td>

                <td>{{ item.precio }}</td>

                <td>{{ item.pedido_date}}</td>

                <td><button @click.prevent="del(item.id)">x</button></td>

            </tr>
        </tbody>

    </estructura>

    <foot :pagination="pagination" :filtrardatos="filtrardatos" @Atras="--pagination.currentPage" @Siguiente="++pagination.currentPage"></foot>
        </div>


       <div class="alert alert-danger" role="alert" v-if="resp">
  {{ resp }}
</div>

</div>
</template>

<script>
import pedidocomponent from '../../components/pedidos/PedidoComponent';
import procesos from '../../tabla'
export default {
     components: {
        pedidocomponent:pedidocomponent
    },


    mixins: [procesos],

    data() {
        let titulohead = [

           {
                label: 'ID',
                name: 'id',
                type: 'number'
            },
            {
                label: 'MARCA',
                name: 'MARCA',
                type: 'text'
            },
            {
                label: 'PRODUCTO',
                name: 'nombrep',
                type: 'text'
            },
             {
                label: 'CLIENTE',
                name: 'cantidad',
                type: 'text'
            },
            {
                label: 'CANT.',
                name: 'cantidad',
                type: 'text'
            },
            {
                label: 'PRECIO',
                name: 'PRECIO',
                type: 'number'
            },
            {
                label: 'FECHA',
                name: 'pedido_date',
                type: 'number'
            },


        ]
        let opcions = []

        return {
            titulo: 'Tabla pedidos',
                                  selected: 3,
            opcions: [{
                    cantidad: 3
                },
                {
                    cantidad: 6
                },
                {
                    cantidad: 9
                }
            ],
            colhead: titulohead,
            contenido: [],
            url: 'pedidos',
            fechas: false,
            search: "",
            total: 0,
            urldel:'pedidos',
            resp:"",
            urlsav:'pedidos',

            nombrep:"",
            desc:"",
            precio:"",


            botones:{
            editando:false,
                      llave:"",
            estado:"Guardar",
            onoff:""
                                             },

            pagination: {
                currentPage: 1,
                total: '',
                nextPage: '',
                prevPage:             '',
                from: '',
                to: ''
            },

        }
    },

    methods:{



      del(id) {
            var url = this.urldel + '/' + id;
            axios.delete(url).then(
                response => {
                     this.getContenido();
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
