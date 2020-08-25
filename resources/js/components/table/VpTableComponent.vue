<template>
<div  class="row">
        <div class="col-12 col-sm-6" >
                    <productoscomponent @res='this.reset'></productoscomponent>
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

                <td >{{ item.nombrep }}</td>

                <td >{{ item.desc }}</td>

                <td> {{ item.precio }}</td>
                <td><input type="text " disabled v-model="botones.onoff" v-if="botones.onoff"></td>

                <td><button @click.prevent="del(item.id)">x</button></td>
               <td><button @click="editar(item.id,item.nombrep, item.desc,item.precio)"> <i class="nav-icon fa fa-edit"></i></button></td>

            </tr>
        </tbody>
         <tbody v-else>

            <tr v-for="item in  paginated" :key="item.id">
                <td>{{ item.id }}</td>
                <td  v-if="item.id===botones.llave"><input type="text" v-model="nombrep" name="nombrep" id="nombrep" ></td>
                <td v-else>{{ item.nombrep }}</td>
                <td v-if="item.id===botones.llave"><input type="text" v-model="desc" name="desc" id="desc"  ></td>
                <td v-else >{{ item.desc }}</td>
                <td  v-if="item.id===botones.llave"><input type="number" v-model="precio" name="precio" id="precio" ></td>
                <td v-else> {{ item.precio }}</td>
                <td><button @click="guardar(item.id)"> <i class="nav-icon fa fa-save" v-if="item.id===botones.llave"></i>
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
import productoscomponent from '../../components/productos/VProductoComponent';
import procesos from '../../tabla'
export default {
     components: {
        productoscomponent:productoscomponent
    },


    mixins: [procesos],

    data() {
        let titulohead = [

            {
                label: 'Id',
                name: 'id',
                type: 'number'
            },

            {
                label: 'PRODUCTO',
                name: 'nombrep',
                type: 'text'
            },
             {
                label: 'DESCRIPCION',
                name: 'descripcion',
                type: 'text'
            },
            {
                label: 'PRECIO',
                name: 'precio',
                type: 'text'
            },


        ]
        let opcions = []

        return {
            titulo: 'Tabla Productos',
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
            url: 'producto',
            fechas: false,
            search: "",
            total: 0,
            urldel:'producto',
            resp:"",
            urlsav:'producto',

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
                prevPage: '',
                from: '',
                to: ''
            },

        }
    },

    methods:{


  guardar(id) {
       if((this.nombrep==="" )|| (this.desc==="") || (this.precio==="")){
alert('Uno de los campos se encuentra Vacio')
  }
  else{
            axios.put(this.url + '/' + id, {
                    nombrep: this.nombrep,
                    desc: this.desc,
                    precio: this.precio,
                    id: id
                })
                .then(response => {
                    this.ok = response.data;
                    this.botones.editando = false;
                    this.botones.llave = "";
                    alert(`Los  datos fueron actualizados correctamente  Id=${id}, Marca=${this.nombrep}, producto=${this.desc}, Precio=${this.precio}.`)
                    location.reload();

                })
                .catch(errors => {
                    console.log(this.errors);
                });
          }
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
          editar(id,nombre,desc,precio) {

            this.botones.editando = true;
            this.botones.llave = id;
            this.nombrep=nombre
            this.desc=desc;
            this.precio=precio;
        },

    }



}
</script>
