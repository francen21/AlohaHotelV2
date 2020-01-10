<template>

<div class="container">
    <div class="card">
    <div class="card-header py-2">
        <h3 class="m-0 font-weight-bold text-primary float-left pt-1">Front Panel</h3>
        <div class="float-right">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle butroomss my-1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Floor
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle butroomss my-1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Room Side
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle butroomss my-1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Room Type
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                    <a class="dropdown-item" href="#">Thing</a>
                </div>
            </div>

            <div class="form-check-inline">
                <input class="ml-2" type="text" id="from" name="from" placeholder="Date from">
                <input class="ml-2" type="text" id="to" name="to" placeholder="Date to">
            </div>
        </div>




    </div>
    <div class="card-body pt-0">
        <table class="table table-sm p-0 my-2" id="frontPanel">
            <thead class="thead-dark">
                <th class="text-center">Room Number</th>
                <th class="text-center">Reservation</th>
                <th class="text-center">Floor</th>
                <th class="text-center">Room Type</th>
                <th class="text-center">Balance </th>
                <th class="text-center">Details </th>
                <th class="text-center">Actions </th>
                <th class="text-center">Services </th>
                <th class="text-center">HouseKeeping </th>
                <th class="text-center">Payments </th>
            </thead>
            <tbody>
                <tr  v-for="room in rooms" :key="room.room_id" >
                    <th align="text-center">{{room.room_number}}</th>
                    <td align="center" v-if="!room.reservation.length">Vacant</td>
                    <td align="center" v-else>Reserved</td>
                    <td align="center">{{room.room_floor }}</td>
                    <td align="center">{{room.room_type  }}</td>
                    <td align="center">{{room.room_rate  }}</td>
                    <td align="center">
                        <!--   $room->id        -->
                        <button @click="openDetailsModal(room.reservation,room)" type="button" class="btn btn-primary btn-sm"
                            aria-haspopup="true" aria-expanded="false" style="padding: 0.25px 4.5px;">
                            <i class="fas fa-info-circle"></i> Details
                        </button>
                    </td>
                    <td align="center" v-if="room.room_status !== 'Available'">
                        <button @click="openCheckinModal()" type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            aria-haspopup="true" aria-expanded="false"
                            style="padding: 0.25px 4.5px;">
                            <i class="fas fa-check-circle"></i> Check In
                        </button>
                    </td>
                    <td align="center" v-else>
                        <button @click="openReserveModal()" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                            aria-haspopup="true" aria-expanded="false"
                            style="padding: 0.25px 4.5px;">
                            <i class="fas fa-check-circle"></i> Reserve
                        </button>
                    </td>
                    <td align="center" v-if="room.room_status !== 'Available'">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0.25px 4.5px;">
                                <i class="fas fa-concierge-bell"></i>Services
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">Other Services </div>
                                <a class="dropdown-item" @click="openChangeRoomModal(room.reservation)" data-toggle="modal">Change room</a>
                                <a class="dropdown-item" @click="openEditGuestModal(room.reservation[0].guest)" data-toggle="modal">Edit Guest</a>
                                <a class="dropdown-item" @click="cancelReservation(room.reservation)" data-toggle="modal">Cancel Booking</a>
                            </div>
                        </div>
                    </td>
                    <td align="center" v-else>
                    </td>
                    <td align="center" v-if="room.room_status !== 'Available'">
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
                    <td align="center" v-else>
                        <button @click="cleanReq()" class="btn btn-sm btn-danger font-weight-light" style="padding: 0.25px 4.5px;" title="Clean Request" data-toggle="tooltip"><i class="fas fa-broom"></i> Clean Request</button>
                    </td>
                    <td align="center" v-if="room.room_status !== 'Available'">
                        <div class="dropdown">
                            <button type="button"
                                class="btn btn-danger btn-sm dropdown-toggle font-weight-light butrooms"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                                style="padding: 0.25px 4.5px;">
                                <i class="fas fa-file-invoice-dollar"></i> Payment
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">Payments</div>
                                <a class="dropdown-item" href="#" data-toggle="modal">Add Payment</a>
                                <a class="dropdown-item" href="#" data-toggle="modal">Delete Payment</a>
                                <a class="dropdown-item" href="#" data-toggle="modal">View Payment</a>
                            </div>
                        </div>
                    </td>
                    <td align="center" v-else>
                    </td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <DETAILS ref="details"></DETAILS>
        <CHECKIN ref="checkin"></CHECKIN>
        <RESERVE ref="reserve"></RESERVE>
        <EDITGUEST ref="editguest"></EDITGUEST>
        <CHANGEROOM ref="changeroom"></CHANGEROOM>
    </div>
    </div>


    </div>


</template>

<script>
import CHECKIN from './Modals/m_frontoffice/checkin'
import DETAILS from './Modals/m_frontoffice/details'
import EDITGUEST from './Modals/m_frontoffice/editguest'
import CHANGEROOM from './Modals/m_frontoffice/changeroom'
import RESERVE from './Modals/reservations/addreservation'
    export default {
        data() {
              return {
                editMode:true,
                rooms:{},
                room_form: new Form({
                    room_id: '',
                    room: '',
                    room_number: '',
                    room_type: '',
                    room_floor: '',
                    room_tarrif: ''
                })
            }
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
                            axios.delete('api/reservation/'+id.reservation_id).then(()=>{

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
                this.$refs.details.form.reservation_number = res.length;
                $('#detailsModal').modal('show');
            },
            openCheckinModal(){
                $('#checkinModal').modal('show');
            },
            openChangeRoomModal(res){
                this.$refs.changeroom.form.fill(res[0]);

                console.log(res[0]);
                $('#changeRoom').modal('show');
            },
            openEditGuestModal(res){
                console.log(res);
                this.$refs.editguest.form.fill(res);
                $('#editGuest').modal('show');
            },
            openAddServiceModal(){

            },
            openAddPayModal(){

            },
            openViewPayModal(){

            },
            openReserveModal(){
                $('#reserve').modal('show');
            },
            openModal(){

            },
            cleanReq(){

            },
            function() {
                var dateFormat = "mm/dd/yy",
                from = $( "#from" )
                    .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                    })
                    .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

                function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
                }
            }
        },
        mounted() {
            this.loadRooms();
            this.function();
            console.log('Component mounted.')
        },
        created(){
            $('#frontPanel').DataTable();
            Fire.$on('itmCreated',()=>{
                 this.loadRooms();
            });
        },
        components: {
            CHECKIN,
            DETAILS,RESERVE,EDITGUEST,CHANGEROOM
        }
    }
</script>
