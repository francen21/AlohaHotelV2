<template>

<div class="container">

    <div v-if="!$gate.isAdmin()">
        <not-found></not-found>
    </div>

    <div class="card" v-if="$gate.isAdmin()">

        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary float-left">Floor Manager</h3>
            <button type="button" class="btn btn-info add-new float-right" @click="openAddModal">
                <i class="fa fa-plus"></i> Add New
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm p-0 m-2">
                <thead class="thead-dark">
                    <th scope="col">Room Number</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody>
                    <tr v-for="room in rooms" :key="room.room_id">
                        <td>{{room.room_number}}</td>
                        <td>{{room.room_type  }}</td>
                        <td>{{room.room_floor }}</td>
                        <td>{{room.room_status}}</td>
                        <td>
                        <button type="submit" class="btn btn-success" @click="openEditModal(room)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                        <button type="submit" class="btn btn-danger" @click="removeRoom(room.room_id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="addRoom" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode" class="modal-title">Edit Room</h5>
                        <h5 v-show="!editMode" class="modal-title" id="editreserve">Add Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateRoom() : createRoom()">
                    <div class="modal-body">

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="room_number">Room Number</label>
                                        <input v-model="room_form.room_number" min="1"  type="number" class="form-control"
                                        :class="{ 'is-invalid': room_form.errors.has('room') }" id="room_number" placeholder="Ex. 301 / 230" />
                                        <has-error :form="room_form" field="room"></has-error>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="room_type">Room Type</label>
                                        <select v-model="rate" class="form-control" name="room_type" :class="{ 'is-invalid': room_form.errors.has('room_type') }">
                                            <option selected>Choose Side..</option>
                                            <option v-for="type in types" :key="type.id" :value="type">{{type.type}}</option>
                                        </select>
                                        <has-error :form="room_form" field="room"></has-error>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="floor">Floor</label>
                                            <input v-model="room_form.room_floor"  type="number" min="1" class="form-control" id="floor" placeholder="Room Floor" required/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="capacity">Capacity</label>
                                            <input v-model.number="rate.capacity" type="number" min="1" class="form-control" id="capacity" readonly disabled/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="rate">Price</label>
                                            <input v-model.number="rate.rate" type="number" class="form-control" id="rate" readonly disabled/>
                                        </div>
                                </div>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Add Room</button>
                        <button v-show="editMode" type="submit" class="btn btn-sm btn-primary">Edit Room</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
<!--
room_number
room_type
floor
tarrif
-->
<script>
export default {
     data() {
            return {
                editMode:true,
                rooms:{}, types:{},
                room_form: new Form({
                    room_id: '',
                    room: '',
                    room_number: '',
                    room_type: '',
                    room_floor: ''
                }),
                rate: new Form({
                    id: '',
                    type: '',
                    capacity: '',
                    rate: '',
                })
            }
    },
    methods:{
        openEditModal(room){
            this.room_form.fill(room)
            this.editMode = true;
            $('#addRoom').modal('show');
        },
        openAddModal(){
            this.room_form.reset();
            this.editMode = false;
            $('#addRoom').modal('show')
        },
        load(){
                axios.get('api/rate').then(({data})=>(this.types = data.data));
                axios.get('api/room').then(({data})=>(this.rooms = data.data));
        },
        createRoom(){
                this.room_form.room_type = this.rate.type;
                this.room_form.room = this.room_form.room_floor.concat(this.room_form.room_number);
                this.room_form.room_tarrif = parseFloat(this.room_form.room_tarrif).toFixed(2);
                this.$Progress.start();
                this.room_form.post('api/room').then(()=>{
                    Fire.$emit('action');
                    $('#addRoom').modal('hide')
                    this.room_form.reset();
                    Toast.fire({
                        icon: 'success',
                        title: 'Room added successfully'
                    })
                    this.$Progress.finish();
                    this.loadReservationsCont();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });

        },
        removeRoom(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/room/'+id).then(()=>{
                                    Fire.$emit('action');
                                    Swal.fire(
                                    'Deleted!',
                                    'The room has been deleted.',
                                    'success'
                                    )


                            }).catch(()=>{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'

                                })
                            });
                        }

                    })
        },
        updateRoom(){
                this.$Progress.start();
                this.room_form.room_type = this.rate.type;
                this.room_form.room = this.room_form.room_floor.concat(this.room_form.room_number);
                this.room_form.room_tarrif = parseFloat(this.room_form.room_tarrif).toFixed(2);
                this.room_form.put('api/room/'+ this.room_form.room_id).then(()=>{
                    Fire.$emit('action');
                    $('#addRoom').modal('hide')
                    this.room_form.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Room Updated'
                    })
                    this.$Progress.finish();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });


        }

    },
    mounted() {
    },
    created(){
        this.load();
        Fire.$on('action',()=>{
                 this.load();
        });

    },
};
</script>
