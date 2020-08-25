<template>
<div class="col-12 col-sm-3">
                <!-- small card -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3> {{ valor4 | currency }}</h3>

                        <p>Rendimiento</p>
                    </div>
                    <div class="icon">
                        <i class="fas  fa-balance-scale"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Total
                  </a>
                </div>
            </div>

</template>

<script>
import Axios from 'axios'
import Vue2Filters from 'vue2-filters'
    export default {
         mixins: [Vue2Filters.mixin],
props:['valor4']

        }


</script>
