
<template>

 <div class="col-12 col-sm-3">
                <!-- small card -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h1>{{ valor2 | currency }}</h1>
                        <p>Otros</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ingresos
                  </a>
                </div>
            </div>
</template>

<script>
import Axios from 'axios'
import Vue2Filters from 'vue2-filters'
    export default {
        mixins: [Vue2Filters.mixin],
props:['valor2']
        }


</script>
