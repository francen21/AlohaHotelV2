<template>

<!-- Card Example -->
<div class="card">
    <div class="card-header py-2">
        <h3 class="m-0 font-weight-bold text-primary">Frony Panel</h3>

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
                <th class="text-center">Guest Name</th>
                <th class="text-center">Floor</th>
                <th class="text-center">Room Type</th>
                <th class="text-center">Status </th>
                <th class="text-center">Balance </th>
                <th class="text-center">Details </th>
                <th class="text-center">Actions </th>
                <th class="text-center">Services </th>
                <th class="text-center">HouseKeeping </th>
                <th class="text-center">Payments </th>
            </thead>
            <tbody>

                <tr>
                    <th scope="row" width="8%"> $room->room_name</th>
                    <td align="center"> $room->guest['guest_name']</td>
                    <td align="center"> $room->room_floor</td>
                    <td align="center"> $room->room_type</td>
                    <td align="center"> $room->room_status</td>
                    <td align="center">PHP $room->room_rate</td>

                    <td align="center" width="5%">
                         <!--   $room->id        -->
                        <button type="button" class="btn btn-primary btn-sm open-modal" value="$room->id"
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
    </div>
</div>

</template>

<script>
import CHECKIN from './Modals/m_frontoffice/checkin'
    export default {
        data() {
             return {
      // Create a new form instance
      form: new Form({

      })
    }
        },
        mounted() {
            console.log('Component mounted.')
        }
        ,
        components: {
            CHECKIN
        }
    }
</script>
