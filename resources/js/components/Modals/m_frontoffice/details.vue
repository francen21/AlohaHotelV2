<template>
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title" id="detailsModal">Guest Information</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header py-1">
                                    Reservation
                                </div>
                                <div class="card-body pl-1 py-1 pr-0">
                                    <table class="table table-borderless table-sm p-0 m-0">
                                        <tbody>
                                            <tr>
                                                <th>Booking Number: </th>
                                                <td  id="booking_id"></td>

                                            </tr>
                                            <tr>
                                                <td>Room Number: </td>
                                                <td id="room_name"></td>

                                            </tr>
                                            <tr>
                                                <th>Booked By: </th>
                                                <td id="booked_by"></td>

                                            </tr>
                                            <tr>
                                                <td>Booking Remarks: </td>
                                                <td id="remarks"></td>
                                            </tr>
                                            <tr>
                                                <th>Check-In Date: </th>
                                                <td id="roomcd"></td>
                                            </tr>
                                            <tr>
                                                <td>Check-Out Date: </td>
                                                <td id="roomcod"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
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
                            <div class="card">
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
                        <div class="col-6">
                            <div class="card">
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
                <div class="modal-footer">
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

            }
        },
        methods:{
            loadCont(){
                axios.get('api/room')
                    .then(({data})=>(this.data_form = data.data));
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
