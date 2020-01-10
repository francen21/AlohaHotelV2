<template>

    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Modal Tittle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm">Blue Button</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{

            }
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
