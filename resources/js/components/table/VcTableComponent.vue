<template>
<div  class="row" >
        <div class="col-12 col-sm-6 ">
                    <clientecomponent @res='this.reset'></clientecomponent>
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

                <td >{{ item.codigo }}</td>

                <td >{{ item.nombre }}</td>

                <td> {{ item.direccion }}</td>
                <td> {{ item.tel }}</td>
                <td> {{ item.visita }}</td>
                <td><input type="text " disabled v-model="botones.onoff" v-if="botones.onoff"></td>

                <td><button @click.prevent="del(item.id)">x</button></td>
               <td><button @click="editar(item.id, item.codigo, item.nombre, item.direccion, item.tel, item.visita)"> <i class="nav-icon fa fa-edit"></i></button></td>

            </tr>
        </tbody>
         <tbody v-else>

            <tr v-for="item in  paginated" :key="item.id">
                <td>{{ item.id }}</td>
                 <td  v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="codigo" name="codigo" id="codigo" required ></td>
                <td v-else>{{ item.codigo }}</td>
                <td  v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="nombre" name="nombre" id="nombrep"  required></td>
                <td v-else>{{ item.nombre }}</td>
                <td v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="direccion" name="dir" id="dir"   required></td>
                <td v-else >{{ item.direccion }}</td>
                <td  v-if="item.id===botones.llave"><input type="number" class="form-control" v-model="tel" name="tel" id="tel"  required></td>
                <td v-else> {{ item.tel }}</td>
                 <td  v-if="item.id===botones.llave"><input type="text" class="form-control" v-model="visita" name="visita" id="visita"  required></td>
                <td v-else> {{ item.visita }}</td>
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
import clientecomponent from '../../components/clientes/VclienteComponent';
import procesos from '../../tabla'
export default {
     components: {
        clientecomponent:clientecomponent
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
                label: 'CODIGO',
                name: 'codigo',
                type: 'text'
            },
             {
                label: 'NOMBRE',
                name: 'nombre',
                type: 'text'
            },
            {
                label: 'DIRECCION',
                name: 'precio',
                type: 'text'
            },
             {
                label: 'TEL',
                name: 'TEL',
                type: 'text'
            },
             {
                label: 'VISITA',
                name: 'VISITA',
                type: 'text'
            },

        ]
        let opcions = []

        return {
            titulo: 'Tabla clientes',
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
            url: 'cliente',
            fechas: false,
            search: "",
            total: 0,
            urldel:'cliente',
            resp:"",
            urlsav:'cliente',


            codigo:"",
            nombre:"",
            direccion:"",
            tel:"",
            visita:"",

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
  if((this.visita==="" )|| (this.codigo==="") || (this.nombre==="")|| (this.direccion==="")|| (this.tel==="")){
alert('Uno de los campos se encuentra Vacio')
  }
  else{
            axios.put(this.url + '/' + id, {

                   codigo: this.codigo,
                   nombre: this.nombre,
                    direccion: this.direccion,
                    tel: this.tel,
                     visita: this.visita,
                    id: id
                })
                .then(response => {
                    this.ok = response.data;
                      this.botones.editando = false;
                      this.botones.llave = "";
                      alert(`Los  datos fueron actualizados correctamente  Id=${id}, Codigo=${this.codigo}, Nombre=${this.nombre}, Direccion=${this.direccion}, Telefono=${this.tel}, Visita=${this.visita}`)
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
           editar(id,codigo,nombre,direccion,tel,visita) {

            this.botones.editando = true;
            this.botones.llave = id;
            this.codigo=codigo
            this.nombre=nombre
            this.direccion=direccion;
            this.tel=tel;
            this.visita=visita;
        },

    }



}
</script>
