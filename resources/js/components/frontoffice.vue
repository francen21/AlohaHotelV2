<template>

    <div class="container-xl">
        <div class="card">
            <div class="card-header py-2">
                <h3 class="m-0 font-weight-bold text-primary float-left pt-1">Rooms</h3>
                <div class="float-right">
                    <div class="btn-group">

                        <datepicker :value="datepicked" @input="updateNow()"></datepicker>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <b-table id="my-table" :filter="filter" :striped="true" :fields="fields" :borderless="true" :outlined="false" :items="rooms"
                    :per-page="perPage" :current-page="currentPage" :head-variant="headVariant" :tbody-tr-class="rowClass" small>
                    <template v-slot:cell(Guest)="row">

                        <button @click="openReserveModal(row.item)" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    aria-haspopup="true" aria-expanded="false"
                                    style="padding: 0.25px 4.5px;" v-if="row.item.room_status == 'Available' || row.item.room_status == 'Reserved'">
                                    <i class="fas fa-check-circle"></i> Reserve
                        </button>
                        <div v-else>
                            {{hasreservation(row.item)}}
                        </div>
                    </template>
                    <template v-slot:cell(Actions)="row">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example" v-if="row.item.room_status == 'Occupied'">                                                     <!--House-->
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-concierge-bell"></i>Services
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-header">House Keeping </div>
                                             <a class="dropdown-item" @click="service('Laundry',row.item, true)" data-toggle="modal">Laundry</a>
                                             <a class="dropdown-item" @click="service('MiniBar',row.item, false)" data-toggle="modal">MiniBar</a>
                                             <a class="dropdown-item" @click="changeRoomM(row.item)" data-toggle="modal">Change Room</a>
                                             <a class="dropdown-item" @click="service('Others',row.item, true)" data-toggle="modal">Others</a>
                                        </div>
                                    </div>
                                    <!-- <button @click="openpay(row.item.guest_id)" type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-file-invoice-dollar"></i>Payment
                                    </button> -->
                                    <button @click="checkout(row.item,row.item.guest.payments)" v-if="row.item.check_out <= datepicked && row.item.status == 2" type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-check-circle"></i> Check Out
                                    </button>
                                </div>
                            <button @click="openpay(row.item.guest_id)" type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="true" v-if="row.item.room_status == 'Occupied' || row.item.room_status == 'Reserved' ">
                                <i class="fas fa-file-invoice-dollar"></i>Payment
                            </button>
                            <div class="btn-group btn-group-sm" role="group" v-else>
                                <button @click="update(row.item, '3')" class="btn btn-sm btn-success" title="Available" data-toggle="tooltip"><i class="fa fa-plus"></i> Available</button>
                                <button @click="update(row.item, '2')" class="btn btn-sm btn-danger" title="Cleaning" data-toggle="tooltip"><i class="fas fa-broom"></i> Cleaning</button>
                                <button @click="update(row.item, '1')" class="btn btn-sm btn-info" title="Inspection" data-toggle="tooltip"><i class="fas fa-quidditch"></i> Inspection</button>
                                <button @click="update(row.item, '4')" class="btn btn-sm btn-light" title="Maintenance" data-toggle="tooltip"><i class="fas fa-quidditch"></i> Maintenance</button>
                            </div>
                    </template>
                </b-table>
                <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table" class="float-right">
                </b-pagination>
            </div>
        </div>
            <DETAILS ref="details"></DETAILS>
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
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
import Datepicker from 'vuejs-datepicker';

    let datepicked;
    let datenow;
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
                perPage: 10, currentPage: 1, headVariant: 'dark', filter: null,
                editMode:true,rooms:[],reservations:[],res:'',
                fields: [
                    { key: 'room_number', label: 'Room  ' , sortable: true},
                    'Guest',
                    { key: 'room_floor', label: 'Floor', sortable: true },
                    { key: 'room_type', label: 'Type' ,sortable: true},
                    { key: 'room_status', label: 'Status' , sortable: true },
                    'Actions',
                    ],
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
                datepicked:'',
                datenow:'',
                payment_form: new Form({
                    guest_id: '',
                    price: '',
                }),
            }
        },
        computed:{
            rows() {
                return this.rooms.length
            },
        },
        methods:{
            hasreservation(room){
                let reserved = room.reservation.find(function(element) {return element.check_in <= datenow})
                if(reserved){
                    return reserved.guest.guest_name;
                }else{
                    return;
                }
            },
            rowClass(item, type) {
                if (!item || type !== 'row') return
                if (item.room_status == 'Available') return 'table-success'
                if (item.room_status == 'Occupied') return 'table-primary'
                if (item.room_status == 'Reserved') return 'table-warning'
                if (item.room_status == 'For Inspection') return 'table-secondary'
                if (item.room_status == 'Maintenance') return 'table-light'
            },
            loadRooms(){
                this.$Progress.start();
                    axios.get('api/room').then(({data})=>(this.rooms = data.data));
                    axios.get('api/reservation').then(({data})=>(this.reservations = data));
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
            openAddModal(){
                this.$refs.childADD.editMode = false;
                this.$refs.childADD.viewMode = false;
                this.$refs.childADD.reserve = true;
                $('#reserve').modal('show')
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
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                datenow = yyyy + '-' + mm + '-' + dd;
                this.datenow = yyyy + '-' + mm + '-' + dd;
                this.datepicked = yyyy + '-' + mm + '-' + dd;
            },
            update(room, service1){
                if (service1 == 3) {
                    room.room_status = 'Available';
                }
                else if(service1 == 2){
                    room.room_status = 'Cleaning';
                }
                else if(service1 == 4){
                    room.room_status = 'Maintenance';
                }
                else {
                    room.room_status = 'For Inspection';
                }
                Swal.fire({
                    title: 'Changing status to ' + room.room_status +'?',
                    text: "You're changing room "+room.room_number+" status to "+room.room_status+".",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.value) {
                            this.room.fill(room);
                            this.$Progress.start();
                            this.room.post('/roomstatus').then(()=>{
                                Fire.$emit('romCreated');
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

                    })

            }
        },
        mounted() {
            this.loadRooms();
            datepicked = new Date();
            this.updateNow();
        },
        created(){
            $('#frontPanel').DataTable();
            Fire.$on('itmCreated',()=>{
                 this.loadRooms();
            });
        },
        components: {
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
