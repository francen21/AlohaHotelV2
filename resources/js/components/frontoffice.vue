<template>

    <div class="container-xl">
        <div class="card">
            <div class="card-header py-2">
                <h3 class="m-0 font-weight-bold text-primary float-left pt-1">Rooms</h3>
            </div>
            <div class="card-body pt-0">
                <table class="table table-sm p-0 my-2" id="frontPanel">
                    <thead class="thead-dark">
                        <th class="text-center">Room Number</th>
                        <th class="text-center">Floor</th>
                        <th class="text-center">Room Type</th>
                        <th class="text-center">Room Status</th>
                        <th class="text-center">Actions </th>
                    </thead>
                    <tbody>
                        <tr  v-for="room in rooms" :key="room.room_id" v-bind:class='{"bg-secondary" : room.room_status == "Maintenance", "bg-primary" : room.room_status == "Available", "bg-info" : room.room_status == "For Inspection", "bg-danger" : room.room_status == "Cleaning" , "bg-warning" : room.room_status == "Reserved", "bg-success" : room.room_status == "Occupied"}'>
                            <td align="text-center">{{room.room_number}}</td>
                            <td align="center">{{room.room_floor}}</td>
                            <td align="center">{{room.room_type}}</td>
                            <td align="center">{{room.room_status}}</td>
                            <td align="center">
                                <button @click="openReserveModal(room)" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    aria-haspopup="true" aria-expanded="false"
                                    style="padding: 0.25px 4.5px;" v-if="room.room_status == 'Available'">
                                    <i class="fas fa-check-circle"></i> Reserve
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="m-0 font-weight-bold text-primary float-left pt-1">Active Rooms</h3>
                <div class="float-right">
                    <div class="btn-group">
                        <datepicker :value="datepicked" v-model="datepicked" @input="updateNow()"></datepicker>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <table class="table table-sm p-0 my-2" id="reservations">
                    <thead class="thead-dark">
                        <th scope="col">Id</th>
                        <th scope="col">Room</th>
                        <th scope="col">Name</th>
                        <th scope="col">Id Num</th>
                        <th scope="col">Check In</th>
                        <th scope="col">Check out</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(res, index) in reservations" :key="res.reservation_id" v-bind:class='{"bg-primary" : res.status == 1, "bg-success" : res.status == 2, "bg-danger" : res.check_out <= datenow && res.status == 2}'>
                            <td align="center" width="3%">{{res.reservation_id}}</td>
                            <td align="center" width="4%">{{res.room_number}}</td>
                            <td align="center" width="24%">{{res.guest.guest_name+' '+res.guest.guest_lastname}}</td>
                            <td align="center">{{res.guest.guest_number}}</td>
                            <td align="center" width="12%">{{res.check_in}}</td>
                            <td align="center" width="12%">{{res.check_out}}</td>
                            <td align="center" class="col">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <!--
                            House

                            -->
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-concierge-bell"></i>Services
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-header">House Keeping </div>
                                             <a class="dropdown-item" @click="service('Laundry',res, true)" data-toggle="modal">Laundry</a>
                                             <a class="dropdown-item" @click="service('MiniBar',res, false)" data-toggle="modal">MiniBar</a>
                                             <a class="dropdown-item" @click="changeRoomM(res)" data-toggle="modal">Change Room</a>
                                             <a class="dropdown-item" @click="service('Others',res, true)" data-toggle="modal">Others</a>
                                        </div>
                                    </div>
                                    <button @click="openpay(res.guest_id)" type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-file-invoice-dollar"></i>Payment
                                    </button>
                                    <button @click="checkout(res,res.guest.payments)" v-if="res.check_out <= datenow && res.status == 2" type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-check-circle"></i> Check Out
                                    </button>
                                    <button @click="openCheckinModal(res)" v-if="res.check_in === datenow && res.status == 1" type="button" class="btn btn-success btn-sm"  data-toggle="modal"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-check-circle"></i> Check In
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>

            </div>
        </div>
                <DETAILS ref="details"></DETAILS>
                <CHECKIN ref="checkin"></CHECKIN>
                <CHECKOUT ref="checkout"></CHECKOUT>
                <RESERVE ref="reserve"></RESERVE>
                <EDITGUEST ref="editguest"></EDITGUEST>
                <CHANGEROOM ref="changeroom"></CHANGEROOM>
                <SERVICE ref="service"></SERVICE>
                <PAYMENT ref="payment"></PAYMENT>
            <div class="modal fade" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header py-0">
                        <h5 class="modal-title" id="paymentmodalLabel">Insert Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  @submit.prevent="payment()">
                            <div class="row">
                                <div class="col">
                                <input v-model="payment_form.price" type="number" min="0" class="form-control" placeholder="First name">
                                </div>
                                <div class="col">
                                <button type="submit" class="btn btn-primary">Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
    </div>


</template>

<script>
import Datepicker from 'vuejs-datepicker';

// Use v-calendar & v-date-picker components

    import CHECKIN from './Modals/m_frontoffice/checkin'
    import DETAILS from './Modals/m_frontoffice/details'
    import EDITGUEST from './Modals/m_frontoffice/editguest'
    import CHANGEROOM from './Modals/m_frontoffice/changeroom'
    import RESERVE from './Modals/reservations/addreservation'
    import CHECKOUT from './Modals/m_frontoffice/checkout'
    import PAYMENT from './Modals/m_frontoffice/payment'
    import SERVICE from './Modals/m_frontoffice/services'
    export default {
        data() {
              return {
                editMode:true,
                rooms:{},
                reservations:[],
                res:'',
                room_form: new Form({
                    room_id: '',
                    room: '',
                    room_number: '',
                    room_type: '',
                    room_floor: '',
                    room_tarrif: ''
                }),
                charge: new Form({
                    id: '',
                    room_id: '',
                    guest_id: '',
                    code: '',
                    category: '',
                    qty: '',
                    price: '',
                }),
                datenow:'',
                datepicked:'',
                payment_form: new Form({
                    guest_id: '',
                    price: '',
                }),
            }
        },
        computed: {

        },
        methods:{
            loadRooms(){
                this.$Progress.start();
                    axios.get('api/room').then(({data})=>(this.rooms = data.data));
                    axios.get('api/reservation').then(({data})=>(this.reservations = data.data));
                this.$Progress.finish();
            },
            cancelReservation(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/reservation/'+id).then(()=>{

                                    Swal.fire(
                                    'Deleted!',
                                    'Reservation has been canceled.',
                                    'success'
                                    )
                                    Fire.$emit('resCreated');

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
            openDetailsModal(res,rom){
                this.$refs.details.form.fill(rom);
                this.$refs.details.reservations = res;
                $('#detailsModal').modal('show');
            },
            openCheckinModal(data){
                this.$refs.reserve.editMode = false;
                this.$refs.reserve.viewMode = true;
                this.$refs.reserve.reserve = false;
                this.$refs.reserve.reservationData.fill(data);
                this.$refs.reserve.guest.fill(data.guest);
                this.$refs.reserve.room.fill(data.room);
                this.$refs.reserve.rooms = this.rooms;
                $('#reserve').modal('show');
            },

            checkout(data,payments){
                axios.get('api/charge/'+data.room.room_id)
                    .then(({data})=>(
                        this.$refs.checkout.charges = data
                    ));

                this.$refs.checkout.payments = payments;
                this.$refs.checkout.room_form = data.room;
                this.$refs.checkout.resid = data.reservation_id;
                $('#checkout').modal('show');
            },
            openEditGuestModal(res){
                this.$refs.editguest.form.fill(res);
                $('#editGuest').modal('show');
            },
            openpay(id){
                this.payment_form.guest_id = id;
                $('#paymentmodal').modal('show');
            },
            payment(){
                this.$Progress.start();
                this.payment_form.post('api/pay').then(()=>{
                    $('#paymentmodal').modal('hide')
                    this.payment_form.reset();
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
            changeRoomM(data){
                this.$refs.changeroom.form.reservation_id = data.reservation_id;
                this.$refs.changeroom.form.old_roomnumber = data.room_number;
                $('#changeRoom').modal('show');
            },
            changeRoom(){
                this.$Progress.start();
                this.room_form.post('/changeroom').then(()=>{
                    Fire.$emit('itmCreated');
                    $('#changeRoom').modal('hide')
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
            openReserveModal(data){
                this.$refs.reserve.reservationData.reset();
                this.$refs.reserve.guest.reset();
                this.$refs.reserve.room.fill(data);
                this.$refs.reserve.rooms = this.rooms;
                $('#reserve').modal('show');
            },
            service(categ,data, external){
                this.$refs.service.charge.room_id = data.room.room_id;
                this.$refs.service.charge.guest_id = data.guest_id;
                this.$refs.service.charge.category = categ;
                this.$refs.service.external = external;
                $('#actionService').modal('show');
            },
            updateNow() {
                var today = new Date(this.datepicked);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                this.datenow = yyyy + '-' + mm + '-' + dd;
            },
        },
        mounted() {
            this.loadRooms();
            this.datepicked = new Date();
            this.updateNow();
        },
        created(){
            $('#frontPanel').DataTable();
            Fire.$on('itmCreated',()=>{
                 this.loadRooms();
            });
        },
        components: {
            CHECKIN,
            DETAILS,
            RESERVE,
            EDITGUEST,
            CHANGEROOM,
            CHECKOUT,
            Datepicker,
            PAYMENT,SERVICE
        }
    }
</script>
