/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//Pedidos//////
Vue.component('table-component', require('./components/table/CpTablaComponent.vue').default);
Vue.component('pedidocomponent', require('./components/pedidos/PedidoComponent.vue').default);
Vue.component('cpedidocomponent', require('./components/pedidos/PclienteComponent.vue').default);
////Pedidos//////

//////productos//////
Vue.component('vpt-component', require('./components/table/VpTableComponent.vue').default);
Vue.component('pedidocomponent', require('./components/productos/VProductoComponent.vue').default);
//////productos//////

//////productos//////
Vue.component('vct-component', require('./components/table/VcTableComponent.vue').default);
Vue.component('clientecomponent', require('./components/clientes/VclienteComponent.vue').default);
//////productos//////

//////productos//////
Vue.component('vet-component', require('./components/table/VeTableComponent.vue').default);
Vue.component('empresacomponent', require('./components/empresa/VempresaComponent.vue').default);
//////productos//////
//////faturas//////
Vue.component('factura-component', require('./components/facturacion/FacturacionComponent.vue').default);
//////facturas//////
//////reparto//////
Vue.component('reparto-component', require('./components/reparto/RepartoComponent.vue').default);
Vue.component('listaclientes-component', require('./components/reparto/listclientesComponent.vue').default);
//////reparto//////
//////cartera//////
Vue.component('cartera-component', require('./components/balance/BilleteraComponent.vue').default);
Vue.component('cartera3-component', require('./components/balance/BilleteraComponent2.vue').default);
Vue.component('VentasTotal-component', require('./components/balance/VentasTotalcomponent.vue').default);
Vue.component('Otros-component', require('./components/balance/OtrosComponent.vue').default);
Vue.component('Gastos-component', require('./components/balance/GastosComponent.vue').default);
Vue.component('Rendimiento-component', require('./components/balance/RendimientoComponent.vue').default);
Vue.component('tventas-component', require('./components/balance/TablaVentasComponent.vue').default);
Vue.component('Cartera2-component', require('./components/balance/CarteraComponent.vue').default);
Vue.component('tCartera-component', require('./components/balance/TablaCarteraComponent.vue').default);
//////cartera//////
//////tienda//////
Vue.component('base-component', require('./components/tienda/baseComponent.vue').default);
Vue.component('datoslib-component', require('./components/tienda/fomtiendaComponent.vue').default);
//////tienda//////
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});