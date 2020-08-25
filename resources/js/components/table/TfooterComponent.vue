<template>
<div>
    <div class="form-row align-items-center">
       
        

            <span>{{ pagination.from }} - {{pagination.to}} de {{filtrardatos.length}} registros</span>

            <a v-if="pagination.prevPage" class="btn btn-outline-secondary pagination-previous" @click="$emit('Atras');">
                Atras
            </a>
            <a class="btn btn-outline-secondary pagination-previous" v-else :disabled="true">
                Atras
            </a>

            <a v-if="pagination.nextPage" class="btn btn-outline-secondary pagination-next" @click="$emit('Siguiente');">
                Siguiente
            </a>
            <a class="btn btn-outline-secondary pagination-next" v-else :disabled="true">
                Siguiente
            </a>

        </div>
</div>
</template>

<script>
export default {
    props: ['pagination', 'filtrardatos']
}
</script>
