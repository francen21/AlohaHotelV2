<template>

    <div class="modal fade" id="changeRoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-0">
                    <h4 class="modal-title w-100" id="myModalLabel">Room change?</h4>
                    <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="update()">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col mx-4">
                            <label for="room_number">Room Number</label>
                            <select v-model="form.room_number" class="form-control" id="room_number" name="room_number">
                            <option v-for="room in rooms" :key="room.room_id" v-show="room.room_status === 'Available'" v-bind:value="room.room_number">{{room.room_number}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-0">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Change</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                rooms:[],

                form: new Form({
                    reservation_id:'',
                    old_roomnumber:'',
                    new_roomnumber:'',
                }),
            }
        },
        methods:{
            update(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        this.form.patch('api/services/'+ this.form.reservation_id).then(()=>{
                            Fire.$emit('itmCreated');
                            $('#changeRoom').modal('hide')
                            this.form.reset();
                            Swal.fire(
                            'Changed!',
                            'The room is changed.',
                            'success')
                        })
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire(
                        'Cancelled',
                        'Room changing canceled',
                        'error'
                        )
                    }
                })

            },

            loadRooms(){
                axios.get('api/room').then(({data})=>(this.rooms = data.data));
            }
        },
        mounted() {
        },
        created(){
            //this.loadRooms();

        }
    }
</script>
