<template>
<div id="headcomponenent">
   <table class="table table-hover  table-responsive-sm">
        <thead>
                <tr>
                     <th v-for="column in colhead" :key="column.label" >
             {{column.label}}
          </th>
                </tr>
  </thead>

    <slot></slot>
 <tfoot>
      <tr>
          <th v-for="column in colhead" :key="column.label">
             {{column.label}}
          </th>
      </tr>


 </tfoot>
</table>
  </div>


</template>

<script>
    export default {

           props: ['colhead']
    }
</script>