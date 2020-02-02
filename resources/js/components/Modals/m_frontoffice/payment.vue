<template>

</template>

<script>
    export default {
        data(){
            return{
                header:'', items:[], perPage: 10, currentPage: 1, headVariant: 'light', filter: null, file: null, modalShow: false, fields: [
                    { key: 'price', label: 'Payment' , sortable: true},
                    { key: 'created_at', label: 'Date of Payment' },
                    { key: 'price', label: 'Price' },
                    { key: 'created_at', label: 'Created' ,sortable: true},
                    'Actions',
                    ],
            }
        },
        computed: {
            rows() {
                return this.items.length;
            },
        },
        methods:{
            load(){
                this.$Progress.start();
                this.$Progress.finish();
            },
            create(){

            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
        },
        created(){

        }
    }
</script>
