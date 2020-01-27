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
                        <th class="text-center">Services </th>
                        <th class="text-center">HouseKeeping</th>
                    </thead>
                    <tbody>
                        <tr  v-for="room in rooms" :key="room.room_id" >
                            <td align="text-center">{{room.room_number}}</td>
                            <td align="center">{{room.room_floor}}</td>
                            <td align="center">{{room.room_type}}</td>
                            <td align="center">{{room.room_status}}</td>
                            <!-- <td align="center" v-if="room.reservation">
                                <button @click="openDetailsModal(room.reservation,room)" type="button" class="btn btn-sm"
                                    aria-haspopup="true" aria-expanded="false" style="padding: 0.25px 4.5px;">
                                    <i class="fas fa-info-circle"></i> Details
                                </button>
                            </td> -->
                            <td align="center">
                                <button @click="openReserveModal(room)" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    aria-haspopup="true" aria-expanded="false"
                                    style="padding: 0.25px 4.5px;">
                                    <i class="fas fa-check-circle"></i> Reserve
                                </button>
                            </td>
                            <td align="center">
                            </td>
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle font-weight-light"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="padding: 0.25px 4.5px;">
                                        <i class="fas fa-broom"></i> Housekeeping
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-header"> House Keeping </div>
                                        <a @click="openAddService()" class="dropdown-item">Add Service</a>
                                        <a class="dropdown-item">Delete Service</a>
                                    </div>
                                </div>
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
                <h3 class="m-0 font-weight-bold text-primary float-left pt-1">Reservations</h3>
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
                        <tr v-for="(res, index) in reservations" :key="res.reservation_id" v-bind:class='{"bg-primary" : res.status == 1, "bg-success" : res.status == 2}'>
                            <td align="center" width="3%">{{res.reservation_id}}</td>
                            <td align="center" width="4%">{{res.room_number}}</td>
                            <td align="center" width="24%">{{res.guest.guest_name+' '+res.guest.guest_lastname}}</td>
                            <td align="center">{{res.guest.guest_number}}</td>
                            <td align="center" width="12%">{{res.check_in}}</td>
                            <td align="center" width="12%">{{res.check_out}}</td>
                            <td align="center" class="col">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-concierge-bell"></i>Services
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-header">Other Services </div>
                                            <a class="dropdown-item" @click="openChangeRoomModal(room.reservation)" data-toggle="modal">Change room</a>
                                            <a class="dropdown-item" @click="openEditGuestModal(room.reservation[0].guest)" data-toggle="modal">Edit Guest</a>
                                            <a class="dropdown-item" @click="cancelReservation(room.reservation)" data-toggle="modal">Cancel Booking</a>
                                        </div>
                                    </div>
                                    <button @click="openAddPayModal()" type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-file-invoice-dollar"></i>Payment
                                    </button>
                                    <button @click="checkout(res)" v-if="res.check_out >= datenow && res.status == 2" type="button" class="btn btn-danger btn-sm" data-toggle="modal"
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
                <PAYMENT ref="payment"></PAYMENT>
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
                datenow:'',
                datepicked:'',
            }
        },
        computed: {
        },
        methods:{
            loadRooms(){
                this.$Progress.start();
                axios.get('api/room').then(({data})=>(this.rooms = data.data));
                this.$Progress.finish();
            },
            cancelReservation(id){
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/reservation/'+id).then(()=>{

                                    Swal.fire(
                                    'Deleted!',
                                    'Reservation has been canceled.',
                                    'success'
                                    )
                                    Fire.$emit('itmCreated');

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
                this.$refs.reserve.reservationData.fill(data);
                this.$refs.reserve.guest.fill(data.guest);
                this.$refs.reserve.room.fill(data.room);
                this.$refs.reserve.rooms = this.rooms;
                $('#reserve').modal('show');
            },
            checkout(data){
                axios.get('api/charge/'+data.room.room_id)
                    .then(({data})=>(
                        this.$refs.checkout.charges = data
                    ));
                this.$refs.checkout.room_form = data.room;
                this.$refs.checkout.resid = data.reservation_id;
                $('#checkout').modal('show');
            },
            openChangeRoomModal(res){
                this.$refs.changeroom.form.fill(res[0]);
                $('#changeRoom').modal('show');
            },
            openEditGuestModal(res){
                this.$refs.editguest.form.fill(res);
                $('#editGuest').modal('show');
            },
            openAddPayModal(){
                $('#payment').modal('show');
            },
            openViewPayModal(){
            },
            openReserveModal(data){
                this.$refs.reserve.reservationData.reset();
                this.$refs.reserve.guest.reset();
                this.$refs.reserve.room.fill(data);
                this.$refs.reserve.rooms = this.rooms;
                $('#reserve').modal('show');
            },
            openModal(){
            },
            cleanReq(){
            },
            updateNow() {
                var today = new Date(this.datepicked);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                this.datenow = yyyy + '-' + mm + '-' + dd;
            },
            loadReservationsOnce(){
                this.reservations = '';
                axios.get('api/reservation')
                .then(({data})=>(this.reservations = data.data));
            },
        },
        mounted() {
            this.loadRooms();
            this.datepicked = new Date();
            this.updateNow();
            this.loadReservationsOnce();
        },
        created(){
            $('#frontPanel').DataTable();
            Fire.$on('itmCreated',()=>{
                this.loadReservationsOnce();
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
            PAYMENT,
        }
    }
</script>
