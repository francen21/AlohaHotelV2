<template>
    <div class="modal fade" id="actionService" tabindex="-1" role="dialog" aria-labelledby="actionService" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 class="modal-title" v-text="charge.category"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="create()" v-if="external">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="code">Invoice Number/Code</label>
                                    <input type="text" v-model="charge.code" class="form-control" id="code" aria-describedby="Receipt Numbe/Code" placeholder="Transaction Number">
                                    <small id="emailHelp" class="form-text text-muted">Double check receipt code to prevent mistakes.</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="item_price">Total Charge </label>
                                    <input v-model="charge.price"  type="number" min="0.01" step="0.01" class="form-control" id="item_price" placeholder="Total charge" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-0">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                    <form id="addItem" @submit.prevent="create()" v-else>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="item_category">Item Name</label>
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
        </div>
</template>

<script>
    export default {
        data(){
            return{
                external:true,
                charge: new Form({
                    id: '',
                    room_id: '',
                    guest_id: '',
                    code: '',
                    category: '',
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
                }),
                roomnumber:'',
                stocks:{},
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
            load(){
                this.$Progress.start();
                this.$Progress.finish();
            },

            create(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are charging room number "+ this.roomnumber + "  with the amount of "+ this.charge.price+" with the receipt number/code "+ this.charge.code,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, charge'
                    }).then((result) => {

                        if (result.value) {
                            this.$Progress.start();
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
                        }

                })

            },
        },
        created(){
            axios.get('api/inventory').then(({data})=>(this.stocks = data.data));
        }
    }
</script>
