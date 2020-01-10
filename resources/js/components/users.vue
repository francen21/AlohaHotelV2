<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0 font-weight-bold text-black float-left">User Accounts</h3>
                <button type="button" class="btn btn-info add-new float-right" @click="openAddModal()">
                    <i class="fas fa-user-plus"></i> Add New
                </button>
            </div>
            <div class="card-body">
                <table class="table table-sm p-0 m-2">
                    <thead class="table-primary">
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Account Type</th>
                        <th scope="col">Created Timestamp</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.account_id">
                            <td>{{user.name}}</td>
                            <td>{{user.email          }}</td>
                            <td>{{user.type}}</td>
                            <td>{{user.created_at}}</td>
                            <td>
                                <button type="submit" class="btn" @click="openEditModal()" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                                <button type="submit" class="btn" @click="removeRoom()"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>

        </div>
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode" class="modal-title">Edit Room</h5>
                        <h5 v-show="!editMode" class="modal-title">Add Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     <form @submit.prevent="create()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input v-model="uform.name" id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus
                                :class="{ 'is-invalid': uform.errors.has('name') }">
                                <has-error :form="uform" field="name"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input v-model="uform.email" id="email" type="email" class="form-control" name="email" required autocomplete="email"
                                :class="{ 'is-invalid': uform.errors.has('email') }">
                                <has-error :form="uform" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Account Type</label>
                            <div class="col-md-6">
                                <select v-model="uform.type" class="form-control"
                                :class="{ 'is-invalid': uform.errors.has('type') }">
                                <has-error :form="uform" field="type"></has-error>
                                <option selected>Choose Side..</option>
                                <option value="admin">Admin</option>
                                <option value="house keeping">House Keeping</option>
                                <option value="front office">Front Office</option>
                                <option value="accounting">Accounting</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input v-model="uform.password" id="password" type="password" class="form-control" name="password" required autocomplete="new-password"
                                :class="{ 'is-invalid': uform.errors.has('password') }">
                                <has-error :form="uform" field="password"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input v-model="uform.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password"
                                :class="{ 'is-invalid': uform.errors.has('password_confirmation') }">
                                <has-error :form="uform" field="password_confirmation"></has-error>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Register</button>
                        <button v-show="editMode" type="submit" class="btn btn-sm btn-primary">Update</button>
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
                editMode: false,
                users:{},
                uform: new Form({
                    name:'',
                    email:'',
                    type:'',
                    password:'',
                    password_confirmation:'',
                }),
            }
        },
        methods:{
            openEditModal(){
                this.editMode = true;
                $('#addUser').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#addUser').modal('show');
            },
            loadTable(){
                this.$Progress.start();
                axios.get('api/userdata').then(({data})=>(this.users = data.data));
                this.$Progress.finish();
            },
            create(){
                this.uform.post('/register').then(()=>{
                    Fire.$emit('itmCreated');
                    $('#addUser').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'User added successfully'
                    })
                    this.$Progress.finish();
                    this.uform.reset();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
        },
        created(){
            this.loadTable();
            Fire.$on('itmCreated',()=>{
                this.loadTable();
            });
        }
    }
</script>
