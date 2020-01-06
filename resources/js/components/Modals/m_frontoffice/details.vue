<template>
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document" v-bind:class="{ 'modal-sm': !checkedin , 'modal-xl' : checkedin}">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title" id="detailsModal">Room Information</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div v-bind:class="{ 'col-12': !checkedin}">

                                    <table class="table table-borderless table-sm p-0 m-0">
                                        <tbody>
                                            <tr>
                                                <td>Room Number: </td>
                                                <td>{{form.room_number}}</td>
                                            </tr>
                                            <h3 class="ml-1" v-show="!checkedin">Reservations Pending</h3>
                                            <tr v-show="checkedin">
                                                <td>Booking Remarks: </td>
                                                <td id="remarks"></td>
                                            </tr>
                                            <tr v-show="checkedin">
                                                <th >Check-In Date: </th>
                                                <td id="roomcd"></td>
                                            </tr>
                                            <tr v-show="checkedin">
                                                <td>Check-Out Date: </td>
                                                <td id="roomcod"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="info-box mb-2">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                        <div class="info-box-content">
                                          <span class="info-box-text">Pending Reservations</span>
                                          <span class="info-box-number">{{form.reservation_number}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                            <div class="card" v-show="checkedin">
                                <div class="card-header py-1">
                                    Guest Details
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col">
                                                <label>Guest Name:</label>
                                                <label id="name"></label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label>Address:</label>
                                                <label id="street"></label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label>Mobile Number:</label>
                                                <label id="tel"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" v-show="checkedin">
                                <div class="card-header py-1">
                                    Other Information
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless table-sm p-0 m-0">
                                        <tbody>
                                            <tr>
                                                <th>Purpose of Visit:</th>
                                                <td id="purpose"></td>

                                            </tr>
                                            <tr>
                                                <th>Gender: </th>
                                                <td id="gender"></td>

                                            </tr>
                                            <tr>
                                                <td>Numebr of Person: </td>
                                                <td id="persons"></td>
                                            </tr>
                                            <tr>
                                                <th>Grace Period: </th>
                                                <td id="grace"></td>
                                            </tr>
                                            <tr>
                                                <th>Identification Type: </th>
                                                <td id="idtype"></td>
                                            </tr>
                                            <tr>
                                                <th>Identification #: </th>
                                                <td id="idnum"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" v-show="checkedin">
                                <div class="card-header py-1">
                                    Services
                                </div>
                                <div class="card-body">
                                    <div class="card-body pt-1 py-0">

                                        <h6 class="m-0 font-weight-normal text-black">Room Charges</h6>
                                        <hr>
                                        <table class="table table-borderless table-sm p-0 m-0" id="chargename">
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <h6 class="m-0 font-weight-normal text-black">Advanced Payment</h6>
                                        <hr>
                                        <table class="table table-borderless table-sm p-0 m-0">
                                            <tbody>
                                                <tr>
                                                    <th>Room: </th>
                                                    <td></td>
                                                    <td></td>
                                                    <td id="room_tar">Php 4,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Deposit: </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td id="deposit">Php 200.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Balance: </th>
                                                    <td></td>
                                                    <td></td>
                                                    <td id="balance">Php 2,000.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                checkedin: false,
                form: new Form({
                    reservation_number:'',
                    room_number:'',
                    checkin_date:'',
                    checkout_date:''
                })
            }
        },
        methods:{
            loadData(){
            },
            create(){

            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
        }
    }
</script>
