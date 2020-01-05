<template>
 <div class="modal fade" id="editreserve" tabindex="-1" role="dialog" aria-labelledby="Reservation Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h5 v-show="editMode" class="modal-title" id="editreserve">Edit Reservation</h5>
                <h5 v-show="!editMode" class="modal-title" id="editreserve">Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editMode ? updateReservation() : ''">
            <div class="modal-body">



                <div class="form-group">


                    <div class="form-row">
                        <div class="col">
                            <label for="editroom_number">Room Number</label>
                            <select v-model="eform.editroom_number" class="form-control" id="editroom_number" name="editroom_number" :disabled="!editMode">
                            <option value="301">301</option>
                            </select>
                        </div>
                    </div>
                    <!-- FORM ROW - TEXT INPUT-->


                    <div class="form-row">

                        <div class="col-md-12 mb-2">
                            <label for="editguest_name">Name</label>
                            <input v-model="eform.editguest_name" type="text" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_name') }" name="editguest_name" placeholder="Guest Name" :disabled="!editMode">
                            <has-error :form="eform" field="editguest_name"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="editguest_cid">CheckIn Date</label>
                            <input v-model="eform.editguest_cid" type='date' class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_cid') }" id='editguest_cid' name="editguest_cid" placeholder="yyyy/mm/dd" :disabled="!editMode">
                            <has-error :form="eform" field="editguest_cid"></has-error>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="editguest_cod">CheckOut Date</label>
                            <input v-model="eform.editguest_cod" type="date" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_cod') }" id="editguest_cod" name="editguest_cod" placeholder="yyyy/mm/dd" :disabled="!editMode">
                            <has-error :form="eform" field="editguest_cod"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="editguest_cap">Number of guest/s</label>
                            <input v-model="eform.editguest_cap" type="number" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_cap') }" name="editguest_cap" placeholder="Include signing guest" :disabled="!editMode">
                            <has-error :form="eform" field="editguest_cap"></has-error>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="editmobile_number">Mobile Number</label>
                            <input v-model="eform.editguest_mobile" type="text" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editmobile_number') }" name="editmobile_number" placeholder="09XX-XXX-XXXX" :disabled="!editMode">
                            <has-error :form="eform" field="editmobile_number"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="editguest_type">Id Type</label>
                            <select v-model="eform.editguest_type" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_type') }" id="editguest_type" name="editguest_type" :disabled="!editMode">
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
                            <has-error :form="eform" field="editguest_type"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label for="editguest_number">ID Number</label>
                            <input v-model="eform.editguest_number" type="text" class="form-control"
                            :class="{ 'is-invalid': eform.errors.has('editguest_number') }" id="editguest_number" placeholder="ID Number" name="editguest_number" :readonly="!editMode">
                            <has-error :form="eform" field="editguest_number"></has-error>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button v-show="editMode" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button v-show="editMode" type="submit" class="btn btn-primary">Update Reservation</button>
                <button v-show="!editMode" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                editMode: true,
                eform: new Form({
                    editresid:'',
                    editroom_number: '',
                    editguest_name: '',
                    editguest_id: '',
                    editguest_cid: '',
                    editguest_cod: '',
                    editguest_cap: '',
                    editguest_mobile: '',
                    editguest_type: '',
                    editguest_number: '',
                })
            }
        },
        methods:{
            loadReservation(id){

                axios.get('api/reservation/'+id)
                .then(({ data }) => (
                    console.log(data),
                    this.eform.editresid = data.reservation_id,
                    this.eform.editroom_number = data.room_number,
                    this.eform.editguest_name = data.guest.guest_name,
                    this.eform.editguest_id = data.guest.guest_id,
                    this.eform.editguest_cid = data.check_in,
                    this.eform.editguest_cod = data.check_out,
                    this.eform.editguest_cap = data.guest_cap,
                    this.eform.editguest_mobile = data.guest.guest_mobile,
                    this.eform.editguest_type = data.guest.guest_type,
                    this.eform.editguest_number = data.guest.guest_number

                ));

            },
            updateReservation(){
                this.$Progress.start();
                this.eform.put('api/reservation/'+ this.eform.editresid).then(()=>{
                    $('#editreserve').modal('hide')
                    this.eform.reset();
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


            }
        },
        mounted() {
            this.eform.reset();
        },
        created(){

            this.eform.reset();

        }
    }
</script>
