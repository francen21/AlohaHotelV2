<template>

    <div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Check Out</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-sm p-0 m-2">
                                <thead class="table">
                                    <tr>
                                        <th scope="col" colspan="4">
                                            Guest Charges
                                        </th>
                                    </tr>
                                </thead>
                                <thead class="table table-striped">
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Item Price</th>
                                    <th scope="col">Quantity</th>
                                </thead>
                                <tbody>
                                    <tr v-for="charge in charges" :key="charge.id">
                                        <td>{{charge.code}}</td>
                                        <td>{{charge.price}}</td>
                                        <td>{{charge.qty}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-sm p-0 m-2">
                                <thead class="table">
                                    <tr>
                                        <th scope="col" colspan="4">
                                            Guest Payments
                                        </th>
                                    </tr>
                                </thead>
                                <thead class="table table-striped">
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Date</th>
                                </thead>
                                <tbody>
                                    <tr v-for="pay in payments" :key="pay.id">
                                        <td>{{pay.price}}</td>
                                        <td>{{pay.created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="room_number">Room Number</label>
                                        <input v-model="room_form.room_number" min="1"  type="number" class="form-control" id="room_number" disabled readonly/>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="room_type">Room Type</label>
                                        <select v-model="room_form.room_type"  id="room_type" class="form-control" disabled readonly>
                                            <option selected>Choose Side..</option>
                                            <option value="City Side">City Side</option>
                                            <option value="Bay Side">Bay Side</option>
                                            <option value="Suite">Suite</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="floor">Floor</label>
                                            <input v-model="room_form.room_floor"  type="number" min="1" class="form-control" id="floor" disabled readonly/>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="tarrif">Tarrif</label>
                                            <input v-model.number="room_form.room_tarrif" type="number" class="form-control" id="tarrif" disabled readonly/>
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="row px-12">
                        <div class="col">
                            <h3 class=" float-right">Total: {{totalbill ? 'Php '+totalbill : 'Php 0'}}</h3>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

                    <button v-show="totalbill <= 0" type="button" @click="remove()" class="btn btn-primary btn-sm">Proceed Checkout</button>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data(){
            return{
                charges:{},
                payments:{},
                total:'',
                resid   :'',
                room_form: new Form({
                    room_id: '',
                    room: '',
                    room_number: '',
                    room_type: '',
                    room_floor: '',
                    room_tarrif: '',
                    rate: [],
                }),
            }
        },
        computed: {
            totalbill: function () {
            var x = parseFloat(this.room_form.rate.rate);
            this.room_form.room_tarrif = this.room_form.rate.rate;
            for (let index = 0; index < this.charges.length; index++) {
                x += parseFloat(this.charges[index].price);

            }
            for (let index = 0; index < this.payments.length; index++) {
                x -= parseFloat(this.payments[index].price);
            }
            if(x < 0){
                return x = 0;
            }else{
                return x;
                }
            }
        },
        methods:{
            load(){
                this.$Progress.start();
                this.$Progress.finish();
            },
            create(){

            },
            loadcharges(){

            },
            remove(){
                axios.post('/checkout', {
                            id: this.resid
                        }).then(()=>{
                    Fire.$emit('itmCreated');
                    $('#reserve').modal('hide')
                    this.reservationData.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Reservation Updated'
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
            update(){

            }
        },
        mounted() {
        },
        created(){

        }
    }
</script>
