<template>

<div class="container">
    <div class="card">
    <div class="card-header py-2">
        <h3 class="m-0 font-weight-bold text-primary">Front Panel</h3>
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
    </div>
    <div class="card-body pt-0">
        <table class="table table-sm p-0 my-2">
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
                <tr  v-for="room in rooms" :key="room.room_id">
                    <th scope="row"   >{{room.room_number}}</th>
                    <td align="center" v-if="!room.reservation.length">Vacant</td>
                    <td align="center" v-else>Has Reservations</td>
                    <td align="center">{{room.room_floor }}</td>
                    <td align="center">{{room.room_type  }}</td>
                    <td align="center">{{room.room_rate  }}</td>
                    <td align="center" width="5%">
                        <!--   $room->id        -->
                        <button @click="openDetailsModal(room.reservation)" type="button" class="btn btn-primary btn-sm"
                            aria-haspopup="true" aria-expanded="false" style="padding: 0.25px 4.5px;">
                            <i class="fas fa-info-circle"></i> Details
                        </button>
                    </td>
                    <td align="center" width="8%">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#checkinModal" aria-haspopup="true" aria-expanded="false"
                            style="padding: 0.25px 4.5px;">
                            <i class="fas fa-check-circle"></i> Check In
                        </button>
                    </td>
                    <td align="center" width="2%">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="padding: 0.25px 4.5px;">
                                <i class="fas fa-concierge-bell"></i> Services
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">Other Services </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeModal">Change
                                    room</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editgModal">Edit
                                    Guest Info</a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#svdeleteModal">Cancel Booking</a>
                            </div>
                        </div>
                    </td>
                    <td align="center" width="2%">
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle font-weight-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="padding: 0.25px 4.5px;">
                                <i class="fas fa-broom"></i> Housekeeping
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">House Keeping </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hkaddModal">Add
                                    Service</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hkeditModal">Edit
                                    Service</a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#hkdeleteModal">Delete Service</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hkviewModal">View
                                    Service</a>
                            </div>
                        </div>
                    </td>
                    <td align="center" width="2%">
                        <div class="dropdown">
                            <button type="button"
                                class="btn btn-danger btn-sm dropdown-toggle font-weight-light butrooms"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                                style="padding: 0.25px 4.5px;">
                                <i class="fas fa-file-invoice-dollar"></i> Payment
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">Payments </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#payModal">Add
                                    Payment</a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#paydeleteModal">Delete Payment</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#payviewModal">View
                                    Payment</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <DETAILS></DETAILS>
    </div>
    </div>


    </div>


</template>

<script>
import CHECKIN from './Modals/m_frontoffice/checkin'
import DETAILS from './Modals/m_frontoffice/details'
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
            openDetailsModal(res){
                console.log(res['reservation_id']);
                $('#detailsModal').modal('show');
            },
        },
        mounted() {
            this.loadRooms();
            console.log('Component mounted.')
        },
        components: {
            CHECKIN,
            DETAILS
        }
    }
</script>
