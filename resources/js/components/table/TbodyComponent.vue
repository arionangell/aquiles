<template>
<div>
    <h1>{{titulo}}</h1>
    <div class="form-row align-items-center">
        <div class="col-auto">
            <slot name="paginacion"></slot>
        </div>
        <div class="col-auto">
            <div class="input-group-prepend">
                <div class="input-group-text">ß</div>
                <slot></slot>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['titulo']
}
</script>
