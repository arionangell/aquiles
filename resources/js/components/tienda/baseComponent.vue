<template>
<div>
<datoslib-component @Siguiente='recargar'></datoslib-component>
  <div class="col-auto">
            <div class="input-group-prepend" >
                <div class="input-group-text">ß</div>
                <input type="text" class="form-control" v-model="search"  >
              </div>

        </div>
<div class="row">
    <div class="col-12 col-sm-2" v-for="item in filtrardatos" :key="item.id">

<br>
<div class="card" >
     <img :src="item.link"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ item.marca }}</h5>
        <p class="card-text">{{ item.detalle }}</p>
        <p class="card-text">{{ item.producto }}</p>
   <a  class="fa  fa-times-circle alert alert-danger btn"  @click="del(item.id)"></a>
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
    contenido:[],
    res:[],
    id:"",
    url6:'shop2',
    search:""
  }
},
   created() {
        this.getContenido();
        
   },
      methods:{

              getContenido(){
                            axios.get('shop').then(Response => {
                           this.contenido = Response.data
                          

                                                          });
                              },
              recargar(){
                             this.getContenido();
                          },
              del(id) {
                              this.id=id
                              axios.post('shop2', {
                              id: this.id,
                    
                                                      })
                                                        .then(response => {
                                    this.ok = response.data;
            
                   

                })
                .catch(errors => {
                    console.log(this.errors);
                });

this.getContenido();
        },
 
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
