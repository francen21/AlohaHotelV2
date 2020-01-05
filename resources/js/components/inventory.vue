<template>
<div class="card">
    <div class="card-header">
        <h3 class="m-0 font-weight-bold text-primary">Inventory</h3>
        <button @click="openAddModal" type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add New</button>
    </div>
    <div class="card-body">
        <table class="table table-sm p-0 m-2">
            <thead class="thead-dark">
                <th scope="col">Item ID</th>
                <th scope="col">Item Code</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>
                <tr v-for="stock in stocks" :key="stock.stock_id">
                    <td>{{stock.inventory_id}}</td>
                    <td>{{stock.item_code}}</td>
                    <td>{{stock.item_category}}</td>
                    <td>{{stock.item_quantity}}</td>
                    <td>
                        <button type="submit" class="btn btn-success" @click="openEditModal(stock)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                        <button type="submit" class="btn btn-danger"  @click="remove(stock.inventory_id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="actionInventory" tabindex="-1" role="dialog" aria-labelledby="actionInventory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 v-show="editMode" class="modal-title">Edit Room</h5>
                    <h5 v-show="!editMode" class="modal-title">Add Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent=" editMode ? update() : create()">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="item_code">Item Code</label>
                            <input v-model="stock_form.item_code" type="text" class="form-control"
                            :class="{ 'is-invalid': stock_form.errors.has('itemcode') }" id="item_code" aria-describedby="itemCode" placeholder="Enter Item code">
                            <has-error :form="stock_form" field="itemcode"></has-error>
                            <small id="itemCode" class="form-text text-muted">Example: A0938D/ToothBrush</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="item_category">Stock Category</label>
                            <select v-model="stock_form.item_category"  id="item_category" class="form-control">
                                <option selected>Choose Side..</option>
                                <option value="Category 1">Category 1</option>
                                <option value="Category 2">Category 2</option>
                                <option value="Category 3">Category 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="item_quantity">Quantity</label>
                            <input v-model="stock_form.item_quantity"  type="number" class="form-control" id="item_quantity" placeholder="Quantity" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Add Item</button>
                    <button v-show="editMode" type="submit" class="btn btn-sm btn-primary">Edit Item</button>
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
                stocks:{},
                stock_form: new Form({
                    inventory_id:'',
                    item_code:'',
                    item_category:'',
                    item_quantity:''
                }),

            }
        },
        methods:{
            openEditModal(data){
                this.stock_form.fill(data);
                this.editMode = true;
                $('#actionInventory').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#actionInventory').modal('show')
            },
            load(){
                this.$Progress.start();
                axios.get('api/inventory').then(({data})=>(this.stocks = data.data));
                this.$Progress.finish();
            },
            create(){
                this.$Progress.start();
                this.stock_form.post('api/inventory').then(()=>{
                    Fire.$emit('itmCreated');
                    $('#actionInventory').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Room added successfully'
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
                            axios.delete('api/inventory/'+id).then(()=>{
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
                this.stock_form.put('api/inventory/'+ this.stock_form.inventory_id).then(()=>{
                    Fire.$emit('itmCreated');
                    $('#actionInventory').modal('hide')
                    this.stock_form.reset();
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
            Fire.$on('itmCreated',()=>{
                 this.load();
            });
        }
    }
</script>
