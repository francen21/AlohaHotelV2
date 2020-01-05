<template>
<div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h5 class="modal-title" id="checkinModal">Booking/ Check-in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="checkinForm" name="checkinForm">
                    <div class="row">

                        <div class="col-6">

                            <div class="card shadow mb-2">
                                <div class="card-header py-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col float-left px-0" style="padding-right:0;">
                                        <div class="row">
                                            <div class="col">
                                                <label for="booking_num">Booking Number</label>
                                                <input type="text" class="form-control" placeholder="Booking Number"
                                                    id="booking_num" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="room_type">Room Type</label>
                                                <input type="text" class="form-control" placeholder="Room Type"
                                                    id="room_type" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="room_num">Room Number</label>
                                                <input type="text" class="form-control" placeholder="Room Number"
                                                    id="room_num" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-2">
                                <div class="card-header py-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Registration Form</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col float-left px-0" style="padding-right:0;">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_tittle">Tittle</label>
                                                    <select class="form-control" id="guest_tittle">
                                                        <option selected>-Mr./Ms.-</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Mrs</option>
                                                        <option>Miss</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_return">Returning Guest?</label>
                                                </div>
                                            </div>

                                            <label for="guest_name">Guest name</label>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control" id="guest_fname"
                                                        placeholder="First name" value="" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control" id="guest_lname"
                                                        placeholder="Last name" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col mb-2">
                                                    <label for="guest_gender">Gender</label>
                                                    <select class="form-control" id="guest_gender">
                                                        <option selected>-Gender-</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_addr">Address</label>
                                                    <input type="text" class="form-control" id="guest_addr"
                                                        placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_addr_city">City</label>
                                                    <input type="text" class="form-control" id="guest_addr_city"
                                                        placeholder="State" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_addr_country">Country</label>
                                                    <select class="form-control" id="guest_addr_country">
                                                        <option selected>-Select Country-</option>
                                                        <option>Philippines</option>
                                                        <option>United States of America</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md- mb-2">
                                                    <label for="guest_email">E-mail</label>
                                                    <input type="text" class="form-control" id="guest_email"
                                                        placeholder="email.com" required>
                                                </div>
                                            </div>
                                            <label for="guest_mobile_number">Mobile</label>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" class="form-control" id="guest_mobile_areacode"
                                                        placeholder="Area Code" required>
                                                </div>
                                                <div class="col-md-8 mb-2">
                                                    <input type="text" class="form-control" id="guest_mobile_number"
                                                        placeholder="Phone Number" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="room_remarks">Remarks</label>
                                                    <textarea class="form-control" rows="5"
                                                        id="room_remarks"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="card shadow mb-2">
                                <div class="card-header py-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Check-In Information</h6>
                                </div>

                                <div class="card-body">
                                    <div class="col float-left px-0" style="padding-right:0;">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_cidate">Check-in Date</label>
                                                    <input type="text" class="form-control" id="booking_cidate"
                                                        placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_codate">Expected Check-out
                                                        Date</label>
                                                    <input type="text" class="form-control" id="booking_codate"
                                                        placeholder="" value="" required>
                                                </div>
                                            </div>
                                            <label for="booking_tarrif">Tariff</label>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <!-- AUTOMATICALY FILLED MUST -->
                                                    <input type="text" class="form-control" id="booking_tarrif"
                                                        placeholder="PHP automaticaly filled" value="" required>
                                                </div>
                                                <div class="col mb-2">
                                                    <select class="form-control" id="booking_discount">
                                                        <option selected>-Discount. Type-</option>
                                                        <option>VIP</option>
                                                        <option>Regular</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col mb-2">
                                                    <label for="booking_addon">Breakfast</label>
                                                    <select class="form-control" id="booking_addon">
                                                        <option selected>-Set Breakfast-</option>
                                                        <option>Eggs & Bacon</option>
                                                        <option>Egg Sandwitch</option>
                                                        <option>Tuna Sandwitch</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <label for="booking_guest_alter">Alternative Guest Name</label>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control"
                                                        id="booking_guest_alter_first" placeholder="First Name"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control"
                                                        id="booking_guest_alter_last" placeholder="Last Name" required>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_guest_alter_city">City</label>
                                                    <input type="text" class="form-control"
                                                        id="booking_guest_alter_city" placeholder="State" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_guest_alter_country">Country</label>
                                                    <select class="form-control" id="booking_guest_alter_country">
                                                        <option selected>-Select Country-</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_gracep">Grace Time</label>
                                                    <select class="form-control" id="booking_gracep">
                                                        <option selected>-Hour/s-</option>
                                                        <option>1 Hour</option>
                                                        <option>2 Hour</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="booking_find">How did you find us?</label>
                                                    <select class="form-control" id="booking_find">
                                                        <option selected>-Social Media/Newspaper-</option>
                                                        <option>Something</option>
                                                        <option>Something</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-2">
                                <div class="card-header py-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Official Purpose</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col float-left px-0" style="padding-right:0;">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_from">From</label>
                                                    <input type="text" class="form-control" id="guest_from"
                                                        placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_to">To</label>
                                                    <input type="text" class="form-control" id="guest_to" placeholder=""
                                                        value="" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_purpose">Purpose of Visit</label>
                                                    <input type="text" class="form-control" id="guest_purpose"
                                                        placeholder="vacation" value="" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_cap">Number of Person/s: n</label>
                                                    <input type="text" class="form-control" id="guest_cap"
                                                        placeholder="# Persons" value="" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-4 mb-2">
                                                    <label for="guest_male_cap">Male:</label>
                                                    <input type="number" class="form-control" id="guest_male_cap"
                                                        placeholder="no. male" value="" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="guest_female_cap">Female:</label>
                                                    <input type="number" class="form-control" id="guest_female_cap"
                                                        placeholder="no. female" value="" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="guest_child_cap">Children:</label>
                                                    <input type="number" class="form-control" id="guest_child_cap"
                                                        placeholder="no. children" value="" required>
                                                </div>
                                            </div>
                                            <h5 class="mt-2">Alternative Guest Name</h5>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_cashmount">Receive Vash Amount</label>
                                                    <input type="text" class="form-control" id="guest_cashmount"
                                                        placeholder="PHP" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm py-0" data-dismiss="modal">Close</button>
                <button type="button" id="checkinmodal" class="btn btn-primary btn-sm py-0">Save changes</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
