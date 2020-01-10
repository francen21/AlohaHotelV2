<template>

    <div class="modal fade" id="editGuest" abindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header py-0">
                    <h4 class="modal-title w-100">Edit Guest</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <div class="col float-left px-0" style="padding-right:0;">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-2">
                                            <input v-model="form.guest_name" type="text" class="form-control" placeholder="Full Name" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col mb-2">
                                            <label for="guest_gender">Gender</label>
                                            <select class="form-control">
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
                                            <input  type="text" class="form-control" placeholder="Street Address" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-2">
                                            <label for="guest_addr_city">City</label>
                                            <input type="text" class="form-control" placeholder="State" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="guest_addr_country">Country</label>
                                            <select class="form-control">
                                                <option selected>-Select Country-</option>
                                                <option>Philippines</option>
                                                <option>United States of America</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md- mb-2">
                                            <label for="guest_email">E-mail</label>
                                            <input type="text" class="form-control" placeholder="email.com" required>
                                        </div>
                                    </div>
                                    <label for="guest_mobile_number">Mobile</label>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-2">
                                            <input v-model="form.guest_mobile" type="text" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-2">
                                            <label for="room_remarks">Remarks</label>
                                            <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-0">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm">Blue Button</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                editMode: true,
                form: new Form({
                    guest_name: '',
                    guest_id: '',
                    guest_mobile: '',
                    guest_type: '',
                    guest_number: '',
                })
            }
        },
        methods:{
            load(){
                this.$Progress.start();

                this.$Progress.finish();
            },
            create(){

            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
        },
        created(){

        }
    }
</script>
