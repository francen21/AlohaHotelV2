<template>
    <div class="card">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">Guest List</h3>
            <button type="button" class="btn btn-info add-new float-right" @click="openAddModal"><i class="fa fa-plus"></i> Add New</button>
        </div>
        <div class="card-body">
            <table class="table table-sm p-0 m-2">
                <thead class="thead-dark">
                    <th scope="col">Guest ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">ID Type</th>
                    <th scope="col">ID Number</th>
                    <th scope="col">Checkin Points</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    <tr v-for="guest in guests" :key="guest.guest_id">
                        <td>{{guest.guest_id}}</td>
                        <td>{{guest.guest_name}}</td>
                        <td>{{guest.guest_mobile}}</td>
                        <td>{{guest.guest_type}}</td>
                        <td>{{guest.guest_number}}</td>
                        <td>{{guest.guest_checkin_points}}</td>
                        <td>
                            <button type="submit" class="btn btn-success" @click="openEditModal(guest)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                            <button type="submit" class="btn btn-danger" @click="remove(guest.guest_id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>

        <div class="modal fade" id="addGuest" tabindex="-1" role="dialog" aria-labelledby="addGuest" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode" class="modal-title">Edit Guest</h5>
                        <h5 v-show="!editMode" class="modal-title" id="editreserve">Add Guest</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? update() : create()">
                    <div class="modal-body">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="guest_name">Guest Name</label>
                                        <input v-model="guest_form.guest_name"  type="text" class="form-control"
                                        :class="{ 'is-invalid': guest_form.errors.has('guest_name') }" id="guest_name" placeholder="Name" />
                                        <has-error :form="guest_form" field="guest_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="mobile">Contact Number</label>
                                            <input v-model="guest_form.guest_mobile"  type="text" class="form-control" id="mobile" placeholder="Guest contact number" required/>
                                        </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="guest_type">Id Type</label>
                                        <select v-model="guest_form.guest_type" class="form-control"
                                        :class="{ 'is-invalid': guest_form.errors.has('guest_form ') }" id="guest_type" name="guest_type">
                                            <option id="Driver's License">Driver's License</option>
                                            <option id="Philippine Passport">Philippine Passport</option>
                                            <option id="GSIS ID or GSIS UMID Card">GSIS ID or GSIS UMID Card</option>
                                            <option id="SSS ID or SSS UMID Card">SSS ID or SSS UMID Card</option>
                                            <option id="PRC ID">PRC ID</option>
                                            <option id="Integrated Bar of the Philippines ID">Integrated Bar of the Philippines ID</option>
                                            <option id="iDOLE Card">iDOLE Card</option>
                                            <option id="OWWA ID">OWWA ID</option>
                                            <option id="COMELEC Voter’s ID">COMELEC Voter’s ID</option>
                                            <option id="School ID ">School ID</option>
                                            <option id="Voter’s Certification">Voter’s Certification</option>
                                            <option id="Senior Citizen ID from LGU">Senior Citizen ID from LGU</option>
                                            <option id="Government Office and GOCC ID">Government Office and GOCC ID</option>
                                            <option id="Current valid ePassport for renewal of ePassport">Current valid ePassport for renewal of ePassport</option>
                                            <option id="Government-issued ID proving Philippine citizenship">Government-issued ID proving Philippine citizenship</option>
                                            <option id="Alien CoR or ICoR">Alien CoR or ICoR</option>
                                        </select>
                                        <has-error :form="guest_form" field="guest_type"></has-error>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="guest_number">Identification Number</label>
                                            <input v-model="guest_form.guest_number"  type="text" class="form-control" id="guest_number" placeholder="ID number" required/>
                                        </div>
                                </div>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Add Guest</button>
                        <button v-show="editMode" type="submit" class="btn btn-sm btn-primary">Edit Guest</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                editMode: true,
                guests:{},
                guest_form: new Form({
                    guest_id            :'',
                    guest_name          :'',
                    guest_mobile        :'',
                    guest_type          :'',
                    guest_number        :'',
                    guest_checkin_points:'',
                    guest_balance       :''
                }),

            }
        },
        methods:{
            openEditModal(data){
                this.guest_form.fill(data);
                this.guest_form.guest_name = data.guest_name;
                this.editMode = true;
                $('#addGuest').modal('show');
            },
            openAddModal(){
                this.guest_form.reset();
                this.editMode = false;
                $('#addGuest').modal('show')
            },
            load(){
                this.$Progress.start();
                axios.get('api/guest').then(({data})=>(this.guests = data.data));
                this.$Progress.finish();
            },
             create(){
                this.$Progress.start();
                this.guest_form.post('api/guest').then(()=>{
                    Fire.$emit('itmCreated');
                    $('#addGuest').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Guest added successfully'
                    })
                    this.$Progress.finish();
                    this.load();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            remove(id){
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
                            axios.delete('api/guest/'+id).then(()=>{
                                    Fire.$emit('itmCreated');
                                    Swal.fire(
                                    'Deleted!',
                                    'Item deleted.',
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
            update(){
                this.$Progress.start();
                this.guest_form.put('api/guest/'+ this.guest_form.guest_id).then(()=>{
                    Fire.$emit('itmCreated');
                    $('#addGuest').modal('hide')
                    this.guest_form.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Guest Updated'
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
            console.log('Component mounted.')
        },
        created(){
            this.load();
            Fire.$on('itmCreated',()=>{
                this.load();
            });
        }
    }
</script>
