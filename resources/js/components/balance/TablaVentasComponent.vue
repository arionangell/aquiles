<template>
<div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                          <slot name="fechas"></slot>
                        </div>

                        <h3 class="profile-username text-center">Total de Ventas</h3>

                        <p class="text-muted text-center">Los datos cargados son del dia de hoy, para modificar usar los campos de fecha</p>
<slot name="lista1"></slot>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

</template>

<script>
import Axios from 'axios'

    export default {
props:['valor4']
        }


</script>
