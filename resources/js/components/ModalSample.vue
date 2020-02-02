<template>

</template>

<script>
    export default {
        data(){
            return{

            }
        },
        computed: {
            rows() {
                return this.items.length
            },
        },
        methods:{
            showModal() {
                this.$root.$emit('bv::show::modal', 'modal-1', '#btnShow')
            },
            hideModal() {
                this.$refs['my-modal'].hide()
            },
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
