import TheadComponet from './components/table/TheadComponet.vue'
import TfooterComponent from './components/table/TfooterComponent.vue'
import TbodyComponent from './components/table/TbodyComponent.vue'

export default {
    components: {
        estructura: TheadComponet,
        foot: TfooterComponent,
        buscador: TbodyComponent
    },

    created() {
        this.getContenido();


    },

    methods: {

        getContenido() {

            axios.get(this.url).then(Response => {
                this.contenido = Response.data
                this.pagination.total = this.contenido.length;
            });
        },


        paginate(array, selected, pageNumber) {
            this.pagination.from = array.length ? ((pageNumber - 1) * selected) + 1 : ' ';
            this.pagination.to = pageNumber * selected > array.length ? array.length : pageNumber * selected;
            this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
            this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
            return array.slice((pageNumber - 1) * selected, pageNumber * selected);
        },

        resetPagination() {
            this.pagination.currentPage = 1;
            this.pagination.prevPage = '';
            this.pagination.nextPage = '';
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },



        reset() {

            this.getContenido();

        }

    },

    computed: {
        filtrardatos: function() {
            let contenido = this.contenido;
            if (this.search) {
                contenido = contenido.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }

            return contenido;

        },
        paginated() {
            return this.paginate(this.filtrardatos, this.selected, this.pagination.currentPage);
        },



    },



}