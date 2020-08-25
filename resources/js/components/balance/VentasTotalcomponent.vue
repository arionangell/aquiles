
<template>
 <div class="col-12 col-sm-3">
                <!-- small card -->
                <div class="small-box bg-yellow ">

                    <div class="inner">
                      <h1>{{ valor1|currency }}</h1>
                        <p>Total </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a  class="small-box-footer">
                        Ventas
                  </a>
                </div>

            </div>
</template>

<script>
import Axios from 'axios'
import Vue2Filters from 'vue2-filters'
    export default {
        mixins: [Vue2Filters.mixin],
        props:['valor1']
        }

</script>
