<template>

</template>

<script>
    export default {
        data(){
            return{

            }
        },
        methods:{
            openEditModal(data){
                this.data_form.fill(data);
                this.editMode = true;
                $('#Modal').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#Modal').modal('show')
            },
            load(){
                this.$Progress.start();
                axios.get('api/room')
                    .then(({data})=>(this.data_form = data.data));
                this.$Progress.finish();
            },
            loadCont(){
                axios.get('api/room')
                    .then(({data})=>(this.data_form = data.data));
            },
            create(){

            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){

        }
    }
</script>
