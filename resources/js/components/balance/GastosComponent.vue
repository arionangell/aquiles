<template>
      <div class="col-12 col-sm-3">
                <!-- small card -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3> {{ valor3 | currency }}</h3>

                        <p>Gastos</p>
                    </div>
                    <div class="icon">
                        <i class="fas  fa-archive"></i>
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


props:['valor3']
        }


</script>
