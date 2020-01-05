<template>
 <div class="modal fade" id="reserve" tabindex="-1" role="dialog" aria-labelledby="Reservation Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h5 class="modal-title" id="reserve">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createReservation">
            <div class="modal-body">



                <div class="form-group">


                    <div class="form-row">
                        <div class="col">
                            <label for="room_number">Room Number</label>
                            <select v-model="form.room_number" class="form-control" id="room_number" name="room_number">
                            <option value="301">301</option>
                            </select>
                        </div>
                    </div>
                    <!-- FORM ROW - TEXT INPUT-->


                    <div class="form-row">

                        <div class="col-md-12 mb-2">
                            <label for="guest_name">Name</label>
                            <input v-model="form.guest_name" type="text" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_name') }" name="guest_name" placeholder="Guest Name">
                            <has-error :form="form" field="guest_name"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="guest_cid">CheckIn Date</label>
                            <input v-model="form.guest_cid" type='date' class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_cid') }" id='guest_cid' name="guest_cid" placeholder="yyyy/mm/dd">
                            <has-error :form="form" field="guest_cid"></has-error>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="guest_cod">CheckOut Date</label>
                            <input v-model="form.guest_cod" type="date" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_cod') }" id="guest_cod" name="guest_cod" placeholder="yyyy/mm/dd">
                            <has-error :form="form" field="guest_cod"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="guest_cap">Number of guest/s</label>
                            <input v-model="form.guest_cap" type="number" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_cap') }" name="guest_cap" placeholder="Include signing guest">
                            <has-error :form="form" field="guest_cap"></has-error>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="mobile_number">Mobile Number</label>
                            <input v-model="form.guest_mobile" type="text" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('mobile_number') }" name="mobile_number" placeholder="09XX-XXX-XXXX">
                            <has-error :form="form" field="mobile_number"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="guest_type">Id Type</label>
                            <select v-model="form.guest_type" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_type') }" id="guest_type" name="guest_type">
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
                            <has-error :form="form" field="guest_type"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label for="guest_number">ID Number</label>
                            <input v-model="form.guest_number" type="text" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('guest_number') }" id="guest_number" placeholder="ID Number" name="guest_number">
                            <has-error :form="form" field="guest_number"></has-error>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Reservation</button>
            </div>
            </form>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        data() {
            return{

                form: new Form({
                    room_number: '',
                    guest_name: '',
                    guest_cid: '',
                    guest_cod: '',
                    guest_cap: '',
                    guest_mobile: '',
                    guest_type: '',
                    guest_number: '',
                })
            }
        },
        methods:{
            createReservation(){
                this.$Progress.start();
                console.log(this.form);
                this.form.post('api/reservation').then(()=>{
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

            }
        },
        mounted() {
            this.form.reset();
        },
        created(){
            this.form.reset();
        }
    }
</script>
