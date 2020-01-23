<template>
<div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h5 class="modal-title" id="checkinModal">Check-in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                                                    <label for="guest_tittle">Tittle</label>
                                                    <select class="form-control" v-model="guest.guest_tittle">
                                                        <option selected>-Mr./Ms.-</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Mrs</option>
                                                        <option>Miss</option>
                                                    </select>
                                                </div>
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
                                                    <input type="text" class="form-control" placeholder="First name" v-model="reservationData.guest.guest_name" required>
                                                        <has-error :form="guest" field="guest_name"></has-error>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" class="form-control" placeholder="Last name" v-model="reservationData.guest.guest_lastname" required>
                                                    <has-error :form="guest" field="guest_lastname"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="mobile_number">Mobile Number</label>
                                                    <input v-model="guest.guest_mobile" type="text" class="form-control"
                                                    :class="{ 'is-invalid': guest.errors.has('mobile_number') }" name="mobile_number" placeholder="09XX-XXX-XXXX">
                                                    <has-error :form="guest" field="mobile_number"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="guest_type">Id Type</label>
                                                    <select v-model="guest.guest_type" class="form-control"
                                                    :class="{ 'is-invalid': guest.errors.has('guest_type') }" name="guest_type">
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
                                                    <has-error :form="guest" field="guest_type"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_number">ID Number</label>
                                                    <input v-model="guest.guest_number" type="text" class="form-control"
                                                    :class="{ 'is-invalid': guest.errors.has('guest_number') }" placeholder="ID Number" name="guest_number">
                                                    <has-error :form="guest" field="guest_number"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-row">
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
                                            <div class="form-row">
                                                <div class="col-md-12 mb-2">
                                                    <label for="guest_addr">Address</label>
                                                    <input type="text" class="form-control" v-model="guest.guest_address"
                                                        placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="guest_addr_city">City</label>
                                                    <input type="text" class="form-control" v-model="guest.guest_city"
                                                        placeholder="State" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
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
                                                        placeholder="email.com" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
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
                                                        <input v-model="reservationData.check_in" type='date' class="form-control"
                                                        :class="{ 'is-invalid': reservationData.errors.has('check_in') }"  name="check_in" placeholder="yyyy/mm/dd">
                                                        <has-error :form="reservationData" field="check_in"></has-error>
                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <label for="check_out">Expected Check-out Date</label>
                                                        <input v-model="reservationData.check_out" type="date" class="form-control"
                                                        :class="{ 'is-invalid': reservationData.errors.has('check_out') }" name="check_out" placeholder="yyyy/mm/dd">
                                                        <has-error :form="reservationData" field="check_out"></has-error>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="editroom_number">Room Number</label>
                                                        <select v-model="room.room_number" class="form-control" name="room_number">
                                                            <option selected>Select Room</option>
                                                            <option v-for="room in rooms" :key="room.room_id" v-show="room.room_status === 'Available'" v-bind:value="room.room_number">{{room.room_number}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <label for="booking_tarrif">Tariff</label>

                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control" v-model="room.room_tarrif" readonly>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <select class="form-control" v-model="reservationData.discount_type">
                                                            <option selected>Discount Type</option>
                                                            <option>VIP</option>
                                                            <option>Regular</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col mb-2">
                                                        <label for="booking_addon">Breakfast</label>
                                                        <select v-model="reservationData.breakfast" class="form-control">
                                                            <option selected>No Breakfast</option>
                                                            <option>Eggs & Bacon</option>
                                                            <option>Egg Sandwitch</option>
                                                            <option>Tuna Sandwitch</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <label for="booking_guest_alter_first">Alternative Guest Name</label>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <input v-model="guest.alter_name" type="text" class="form-control" placeholder="First Name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input v-model="guest.alter_lastname" type="text" class="form-control" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="booking_guest_alter_city">City</label>
                                                        <input v-model="guest.alter_city" type="text" class="form-control" placeholder="City" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="booking_guest_alter_country">Country</label>
                                                        <select v-model="guest.alter_country" class="form-control">
                                                            <option selected>-Select Country-</option>
                                                            <option>Philippines</option>
                                                            <option>United States of America</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="booking_gracep">Grace Time</label>
                                                        <select v-model="reservationData.grace_time" class="form-control">
                                                            <option value="">Select Hours</option>
                                                            <option value="1:00">1 Hr</option>
                                                            <option value="2:00">2 Hrs</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="booking_find">How did you find us?</label>
                                                        <select class="form-control" v-model="guest.howFind">
                                                            <option value="">Select Medium</option>
                                                            <option value="Social Media">Social Media</option>
                                                            <option value="News Paper">Newspaper</option>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="" v-model="reservationData.from">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="guest_to">To</label>
                                                        <input type="text" class="form-control" placeholder=""
                                                            v-model="reservationData.to">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="guest_purpose">Purpose of Visit</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="vacation" v-model="reservationData.purpose_visit">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="guest_cap">Number of Person/s: n</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="# Persons" :value="addPersons" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-4 mb-2">
                                                        <label for="guest_male_cap">Male:</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="no. male" v-model="reservationData.male_">
                                                    </div>
                                                    <div class="col-4 mb-2">
                                                        <label for="guest_female_cap">Female:</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="no. female" v-model="reservationData.female_">
                                                    </div>
                                                    <div class="col-4 mb-2">
                                                        <label for="guest_child_cap">Children:</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="no. children" v-model="reservationData.children_">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-2">
                                                        <label for="guest_cashmount">Receive Vash Amount</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="PHP">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    import { ModelListSelect } from 'vue-search-select'
    export default {
        data(){
            return{
                editMode: true,
                stocks:{},
                rooms:[],
                guests:[],
                reservationData: new Form({
                    reservation_id:'',
                    room_number:'',
                    guest_id:'',
                    guest_cap:'',
                    discount_type:'',
                    breakfast:'',
                    grace_time:'',
                    purpose_visit:'',
                    from:'',
                    to:'',
                    number_persons:'',
                    male_:0,
                    female_:0,
                    children_:0,
                    check_in:'',
                    check_out:'',
                    created_at:'',
                    room:[],
                    guest:[],
                }),
                guest: new Form({
                    guest_id:'',
                    guest_tittle:'',
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
                    alter_name:'',
                    alter_lastname:'',
                    alter_country:'',
                    alter_city:'',
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
            }
        },
        computed: {
            // a computed getter
            addPersons: function () {
            // `this` points to the vm instance
            var x = parseInt(this.reservationData.male_) + parseInt(this.reservationData.female_)+ parseInt(this.reservationData.children_);

                return x;
            }
        },
        methods:{
            firstnamelastname(item) {
                return `${item.guest_name} ${item.guest_lastname}`
            },
            openEditModal(data){
                this.stock_form.fill(data);
                this.editMode = true;
                $('#actionInventory').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#actionInventory').modal('show')
            },
            loadRooms(){
                axios.get('api/room').then(({data})=>(this.rooms = data.data));
            },
            loadGuests(){
                axios.get('api/guest').then(({data})=>(this.guests = data.data));
            },
            create(){
                this.$Progress.start();
                this.stock_form.post('api/inventory').then(()=>{
                    Fire.$emit('itmCreated');
                    $('#actionInventory').modal('hide')
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
            remove(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/inventory/'+id).then(()=>{
                                    Fire.$emit('itmCreated');
                                    Swal.fire(
                                    'Deleted!',
                                    'Item deleted.',
                                    'success'
                                    )
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
            update(){
                this.$Progress.start();
                this.stock_form.put('api/inventory/'+ this.stock_form.inventory_id).then(()=>{
                    Fire.$emit('itmCreated');
                    $('#actionInventory').modal('hide')
                    this.stock_form.reset();
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
        },
        mounted() {
        },
        created(){
            //this.loadRooms();
            //this.loadGuests();
            Fire.$on('itmCreated',()=>{
                 this.loadRooms();
            });
        },
        components:{
            ModelListSelect
        },
    }
</script>
