<template>
 <div class="modal fade" id="reserve" tabindex="-1" role="dialog" aria-labelledby="Reservation Modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h5 v-if="!editMode || !viewMode" class="modal-title" id="reserve">Reservation</h5>
                <h5 v-else class="modal-title" id="reserve">Check In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editMode ? updateReservation() : viewMode ? checkin() : createReservation()">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card shadow mb-2">
                            <div class="card-header py-1">
                                <h6 class="m-0 font-weight-bold text-primary">Reservation Form</h6>
                            </div>
                            <div class="card-body">
                                    <div class="col float-left px-0" style="padding-right:0;">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_return">Returning Guest?</label>
                                                    <div class="input-group input-group">
                                                        <model-list-select :list="guests" v-model="guest" option-value="guest_id" :custom-text="firstnamelastname" placeholder="select item">
                                                        </model-list-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="guest_name">Guest name</label>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control" placeholder="First name" v-model="guest.guest_name" >

                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control" placeholder="Last name" v-model="guest.guest_lastname" >

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_mobile">Mobile Number</label>
                                                    <input v-model="guest.guest_mobile" type="text" class="form-control" name="guest_mobile" placeholder="09XX-XXX-XXXX">

                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col">
                                                    <label for="guest_type">Id Type</label>
                                                    <select v-model="guest.guest_type" class="form-control" name="guest_type">
                                                        <option id="Driver's License">Driver's License</option>
                                                        <option id="Philippine Passport">Philippine Passport</option>
                                                        <option id="GSIS ID or GSIS UMID Card">GSIS ID or GSIS UMID Card</option>
                                                        <option id="SSS ID or SSS UMID Card">SSS ID or SSS UMID Card</option>
                                                        <option id="PRC ID">PRC ID</option>
                                                        <option id="Integrated Bar of the Philippines ID">Integrated Bar of the Philippines ID</option>
                                                        <option id="iDOLE Card">iDOLE Card</option>
                                                        <option id="OWWA ID">OWWA ID</option>
                                                        <option id="COMELEC Voter’s ID">COMELEC Voter’s ID</option>
                                                        <option id="School ID ">School ID</option>
                                                        <option id="Voter’s Certification">Voter’s Certification</option>
                                                        <option id="Senior Citizen ID from LGU">Senior Citizen ID from LGU</option>
                                                        <option id="Government Office and GOCC ID">Government Office and GOCC ID</option>
                                                        <option id="Current valid ePassport for renewal of ePassport">Current valid ePassport for renewal of ePassport</option>
                                                        <option id="Government-issued ID proving Philippine citizenship">Government-issued ID proving Philippine citizenship</option>
                                                        <option id="Alien CoR or ICoR">Alien CoR or ICoR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_number">ID Number</label>
                                                    <input v-model="guest.guest_number" type="text" class="form-control" placeholder="ID Number" name="guest_number">
                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col mb-2">
                                                    <label for="guest_gender">Gender</label>
                                                    <select class="form-control" v-model="guest.guest_gender">
                                                        <option value="" selected>Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_addr">Address</label>
                                                    <input type="text" class="form-control" v-model="guest.guest_address"
                                                        placeholder="Street Address" >
                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_addr_city">City</label>
                                                    <input type="text" class="form-control" v-model="guest.guest_city"
                                                        placeholder="State" >
                                                </div>
                                                <div class="col-md-6 mb-2" v-if="!reserve">
                                                    <label for="guest_addr_country">Country</label>
                                                    <select class="form-control" v-model="guest.guest_country">
                                                        <option value="" selected>Select Country</option>
                                                        <option>Philippines</option>
                                                        <option>United States of America</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_email">E-mail</label>
                                                    <input type="text" class="form-control" v-model="guest.guest_email"
                                                        placeholder="email.com" >
                                                </div>
                                            </div>
                                            <div class="form-row" v-if="!reserve">
                                                <div class="col-md-12 mb-2">
                                                    <label for="room_remarks">Remarks</label>
                                                    <textarea class="form-control" rows="5"
                                                        id="room_remarks" v-model="guest.guest_remarks"></textarea>
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
                                                        <label for="check_in">Check-in Date</label>
                                                        <input v-model="reservationData.check_in" type='date' class="form-control" name="check_in" placeholder="yyyy/mm/dd"
                                                        :class="{ 'is-invalid': reservationData.errors.has('check_in') }">
                                                        <has-error :form="reservationData" field="check_in"></has-error>

                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <label for="check_out">Expected Check-out Date</label>
                                                        <input v-model="reservationData.check_out" type="date" class="form-control" name="check_out" placeholder="yyyy/mm/dd"
                                                        :class="{ 'is-invalid': reservationData.errors.has('check_out') }">
                                                        <has-error :form="reservationData" field="check_out"></has-error>

                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label for="editroom_type">Room Type</label>
                                                        <select v-model="rate" class="form-control" name="editroom_type" :class="{ 'is-invalid': reservationData.errors.has('room_type') }">
                                                            <option value="" selected>Select Room Type</option>
                                                            <option v-for="rate in rates" :key="rate.id" :value="rate">{{rate.type}}</option>
                                                        </select>
                                                        <has-error :form="reservationData" field="editroom_type"></has-error>
                                                    </div>
                                                </div>
                                                <label for="booking_tarrif">Tariff</label>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control" v-model="rate.rate" readonly>
                                                    </div>
                                                    <div class="col-auto my-1">
                                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Aditional</label>
                                                        <select v-model="additional" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option value="0" selected>Choose...</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button v-if="!editMode && !viewMode" type="submit" class="btn btn-primary">Add Reservation</button>
                <button v-if="editMode && !viewMode" type="submit" class="btn btn-primary">Update Reservation</button>
                <button v-if="!editMode && viewMode" type="submit" class="btn btn-success">Check In</button>
            </div>
            </form>
        </div>
    </div>
</div>

</template>

<script>
    import { ModelListSelect } from 'vue-search-select'
    export default {
        data() {
            return{
                editMode:false,viewMode:false,reserve:true,
                rooms:[],guests:[],rates:[],occupancies:[],
                rate:'',
                additional:0,
                todayreservations:'',
                total_balance:'',
                reservationData: new Form({
                    reservation_id:'',
                    guest_id:'',
                    check_in:'',
                    check_out:'',
                    created_at:'',
                    room:[],
                    guest:[],
                }),
                guest: new Form({
                    guest_id:'',
                    guest_name:'',
                    guest_lastname:'',
                    guest_gender:'',
                    guest_address:'',
                    guest_city:'',
                    guest_country:'',
                    guest_email:'',
                    guest_mobile:'',
                    guest_type:'',
                    guest_number:'',
                    guest_remarks:'',
                    guest_checkin_points:'',
                    guest_balance:'',
                    howFind:'',
                }),
                room: new Form({
                    room_id: '',
                    room: '',
                    room_floor: '',
                    room_type: '',
                    room_tarrif: '',
                    room_number: '',
                    room_sales: '',
                    room_views: '',
                }),
                rate: new Form({
                    id: '',
                    type: '',
                    capacity: '',
                    rate: '',
                }),
                charge: new Form({
                    id: '',
                    room_id: '',
                    guest_id: '',
                    code: '',
                    category: '',
                    price: '',
                    qty: '',
                }),
            }
        },
        computed: {
            tarrif: function () {
                 var x = this.rate.rate;
                this.occupancies.forEach(element => {
                    if(element.occupancy >= ((this.todayreservations/this.rooms.length)*100)){
                        x = parseInt(x*(1+(element.adjustment/100)));
                        this.room.room_tarrif = x;
                        return x;
                    }else{
                        return this.rate.rate;
                    }
                });

            }
        },
        methods:{
            firstnamelastname(data) {
                return `${data.guest_name} ${data.guest_lastname}`
            },
            createReservation(){
                this.loadRooms();
                this.$Progress.start();
                this.reservationData.guest = this.guest;
                this.room.room_type = this.rate.type;
                this.reservationData.room = this.room;
                this.reservationData.post('api/reservation').then(()=>{
                    Fire.$emit('resCreated');
                    $('#reserve').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Reservation added successfully'
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
            updateReservation(){
                this.$Progress.start();
                this.reservationData.guest = this.guest.data();
                this.reservationData.room = this.room.data();
                this.reservationData.put('api/reservation/'+ this.reservationData.reservation_id).then(()=>{
                    Fire.$emit('resCreated');
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
            additionalcharge(){
                    this.charge.code = 'ADPRSN';
                    this.charge.price = 500;
                    this.charge.qty = this.additional;
                    this.charge.category = 'Additional Person';
                    this.charge.post('api/charge');
            },
            checkin(){
                this.$Progress.start();
                if(this.additional > 0){
                    this.additionalcharge();
                }
                this.reservationData.guest = this.guest;
                this.reservationData.put('api/checkin/'+ this.reservationData.room_number).then(()=>{
                    Fire.$emit('itmCreated');
                    $('#reserve').modal('hide')
                    this.reservationData.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Guest Checked In'
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
            loadRooms(){
                axios.get('api/room').then(({data})=>(this.rooms = data.data));
            },
            loadGuests(){
                axios.get('api/guest').then(({data})=>(this.guests = data.data));
            },
            loadRates(){
                axios.get('api/rate').then(({data})=>(this.rates = data.data));
            },
            loadoccu(){
                axios.get('api/occu').then(({data})=>(this.occupancies = data.data));
            },
            loadtoday(){
                axios.get('api/resToday').then(({data})=>(this.todayreservations = data.todayRes));
            },
        },
        mounted() {
            this.reservationData.reset();
            this.loadRooms();
            this.loadGuests();
            this.loadRates();
            this.loadoccu();
            this.loadtoday();
        },
        created(){
            //this.loadRooms();

            //this.form.reset();
        },
        components:{
            ModelListSelect
        },
    }
</script>
