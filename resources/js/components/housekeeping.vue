<template>

<div class="container">

    <div class="card">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">House Keeping</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm p-0 m-2">
                <thead class="thead-dark">
                    <th scope="col">Room Number</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Tariff</th>
                    <th scope="col">Status</th>
                    <th scope="col">Charges</th>
                    <th scope="col">Service</th>
                </thead>
                <tbody>
                    <tr v-for="room in rooms" :key="room.room_id">
                        <td>{{room.room_number}}</td>
                        <td>{{room.room_type  }}</td>
                        <td>{{room.room_floor }}</td>
                        <td>{{room.room_tarrif}}</td>
                        <td>{{room.room_status}}</td>
                        <td v-if="room.room_status === 'Occupied'">
                            <button @click="openAddModal(room)" class="btn btn-sm btn-primary"  title="Add" data-toggle="tooltip"><i class="fa fa-cog"></i></button>
                            <button class="btn btn-sm btn-info"     title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                        </td>
                        <td v-else>
                        </td>
                        <td>
                            <button @click="update(room, '3')" class="btn btn-sm btn-success" title="Available" data-toggle="tooltip"><i class="fa fa-plus"></i> Available</button>
                            <button @click="update(room, '2')" class="btn btn-sm btn-danger" title="Cleaning" data-toggle="tooltip"><i class="fas fa-broom"></i> Cleaning</button>
                            <button @click="update(room, '1')" class="btn btn-sm btn-info" title="Inspection" data-toggle="tooltip"><i class="fas fa-quidditch"></i> Inspection</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal fade" id="actionInventory" tabindex="-1" role="dialog" aria-labelledby="actionInventory" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode" class="modal-title">Edit Item</h5>
                        <h5 v-show="!editMode" class="modal-title">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <label aria-hidden="true">&times;</label>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                            <table class="table table-sm p-0 m-2">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th scope="col" colspan="4">
                                            Guest Charges
                                        </th>
                                    </tr>
                                </thead>
                                <thead class="table-dark">
                                    <th scope="col">Code</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    <tr v-for="charge in charges" :key="charge.id">
                                        <td>{{charge.code}}</td>
                                        <td>{{charge.price}}</td>
                                        <td>{{charge.qty}}</td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm" @click="editCharge(charge)" ><i class="fas fa-pen"></i></button>
                                            <button type="submit" class="btn btn-danger btn-sm" @click="removeCharge(charge.id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>


                            <div class="col">
                                <form id="addItem" @submit.prevent=" editMode ? updateCharge() : create()">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="item_category">Item Code</label>
                                            <select v-model="stock" id="item_category" class="form-control">
                                                <option value="" selected>Choose Side..</option>
                                                <option v-for="stock in stocks" :key="stock.stock_id" v-bind:value="stock">{{stock.item_code+' '+stock.item_price}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="item_quantity">Quantity </label>
                                            <input v-model="charge.qty"  type="number" min="1" class="form-control" id="item_quantity" placeholder="Quantity" required/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Price: {{totalprice ? totalprice : '0'}}</label>
                                            <input v-model="totalprice"  type="number" min="1" class="form-control" id="item_price" placeholder="Quantity" required/>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="modal-footer py-0">
                            <button form="addItem" type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button form="addItem" v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Add Item</button>
                            <button form="addItem" v-show="editMode" type="submit" class="btn btn-sm btn-primary">Update</button>
                            <button @click="resetEditing()" v-show="editMode" type="button" class="btn btn-sm btn-primary">Back</button>
                        </div>


                </div>
            </div>
        </div>
</div>
</template>
<script>
     export default {
        data(){
            return{
                editMode:false,
                rooms:{},
                room_id:'',
                guest_id:'',
                stocks:{},
                charges:{},
                charge: new Form({
                    id: '',
                    room_id: '',
                    guest_id: '',
                    code: '',
                    qty: '',
                    price: '',
                }),
                stock: new Form({
                    inventory_id: '',
                    item_category: '',
                    item_code: '',
                    item_quantity: '',
                    item_price: '',
                    created_at: '',
                    updated_at: '',
                })

            }
        },
        computed: {
            totalprice: function () {
            var x = this.stock.item_price * this.charge.qty;
                this.charge.code = this.stock.item_code;
                this.charge.price = x;
                return x;
            }
        },
        methods:{
            resetEditing(){
                this.charge = '';
                this.editMode = false;
            },
            openEditModal(){
                this.editMode = true;
                $('#actionInventory').modal('show')
            },
            editCharge(data){
                this.editMode = true;
                this.charge.fill(data);
                this.stock.fill(data.stock);
            },
            create(){
                this.$Progress.start();
                this.charge.room_id = this.room_id;
                this.charge.guest_id = this.guest_id;
                this.charge.post('api/charge').then(()=>{
                    Fire.$emit('itmCreated');
                    this.charge.reset();
                    Toast.fire({
                        icon: 'success',
                        title: 'Guest charged'
                    })
                    this.$Progress.finish();
                    Fire.$emit('itmCreated');
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            removeCharge(id){
               Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove charge'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/charge/'+id).then(()=>{
                                    Fire.$emit('itmCreated');
                                    Swal.fire(
                                    'Deleted!',
                                    'Charge deleted.',
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
            updateCharge(){
                this.$Progress.start();
                this.charge.put('api/charge/'+this.charge.id).then(()=>{
                    Fire.$emit('itmCreated');
                    this.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Charge Updated'
                    })
                    this.$Progress.finish();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            openAddModal(data){
                this.loadStock();
                this.editMode = false;
                this.room_id = data.room_id;
                this.guest_id = data.reservation['0'].guest_id;
                this.loadcharges();
                $('#actionInventory').modal('show')
            },
            loadcharges(){
                axios.get('api/charge/'+this.room_id)
                    .then(({data})=>(
                        this.charges = data
                    ));
            },
            load(){
                this.$Progress.start();
                axios.get('api/house')
                    .then(({data})=>(
                        this.rooms = data.data
                    ));
                this.$Progress.finish();
            },
            loadStock(){
                this.$Progress.start();
                axios.get('api/inventory').then(({data})=>(this.stocks = data.data));
                this.$Progress.finish();
            },

            update(room, service1){
                if (service1 == 3) {
                    room.room_status = 'Available';
                }else if(service1 == 2){
                    room.room_status = 'Cleaning';
                }
                 else {
                    room.room_status = 'For Inspection';
                }
                console.log(room.room_status);
                console.log(service1);
                this.room_form.fill(room);
                this.$Progress.start();
                this.room_form.put('api/charge/'+this.room_form.room_id).then(()=>{
                    Fire.$emit('romCreated');
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
            console.log('Component mounted.')
        },
        created(){
            this.load();
            this.loadStock();
            Fire.$on('itmCreated',()=>{
                 this.loadcharges();
            });
        }
    }
</script>
