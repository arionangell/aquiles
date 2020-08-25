<template>
<div  class="row">
        <div class="col-12 col-sm-6">
                    <empresacomponent @res='this.reset'></empresacomponent>
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
        <tbody v-if="(!botones.editando)">

            <tr v-for="item in  paginated" :key="item.id">
                <td>{{ item.id }}</td>

                <td >{{ item.nombree }}</td>

                <td >{{ item.siglas }}</td>




                <td><button @click.prevent="del(item.id)">x</button></td>
               <td><button @click="editar(item.id, item.nombree, item.siglas)"> <i class="nav-icon fa fa-edit"></i></button></td>

            </tr>
        </tbody>
         <tbody v-else>

            <tr v-for="item in  paginated" :key="item.id">
                <td>{{ item.id }}</td>
                 <td  v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="nombree" name="nombre" id="nombrep" ></td>
                <td v-else>{{ item.nombree }}</td>
                <td  v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="siglas" name="nombre" id="nombrep" ></td>
                <td v-else>{{ item.siglas }}</td>

                <td><button @click='guardar(item.id)'> <i class="nav-icon fa fa-save" v-if="item.id===botones.llave"></i>
                <i class="nav-icon fa fa-edit" v-else></i></button></td>
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
import empresacomponent from '../../components/empresa/VempresaComponent';
import procesos from '../../tabla'
export default {
     components: {
        empresacomponent:empresacomponent
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
                label: 'EMPRESA',
                name: 'empresa',
                type: 'text'
            },
             {
                label: 'SIGLAS',
                name: 'siglas',
                type: 'text'
            },


        ]
        let opcions = []

        return {
            titulo: 'Tabla Empresas',
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
            url: 'empresa',
            fechas: false,
            search: "",
            total: 0,
            urldel:'empresa',
            resp:"",
            urlsav:"empresa",


            nombree:"",
            siglas:"",


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
                prevPage: '',
                from: '',
                to: ''
            },

        }
    },

    methods:{


  guardar(id) {
            axios.put(this.url + '/' + id, {

                   nombree: this.nombree,
                   siglas: this.siglas,

                })
                .then(response => {
                    this.ok = response.data;
                    alert(this.ok)


                })
                .catch(errors => {
                    console.log(this.errors);
                });
            this.botones.editando = false;
            this.botones.llave = "";
            this.getContenido();
        },

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
           editar(id,nombree,siglas) {

            this.botones.editando = true;
            this.botones.llave = id;
            this.nombree=nombree
            this.siglas=siglas

        },

    }



}
</script>
