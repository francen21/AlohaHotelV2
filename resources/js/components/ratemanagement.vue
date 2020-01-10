<template>

<div class="container">

    <div class="row p-2">
    <div class="col-6 pr-1">
        <div class="card">
            <div class="card-header">
                Base Rates
                <button  type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add Rate
                </button>
            </div>
            <div class="card-body">
                <table class="table table-sm p-0">
                    <thead class="thead-dark p-0">
                        <th class="py-0" scope="col">Room Type</th>
                        <th class="py-0" scope="col">Rate</th>
                        <th class="py-0" scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Default</td>
                            <td>2,000</td>
                            <td>
                                <a title="Edit" data-toggle="tooltip"><i class="fas fa-pen my-1"></i></a>
                                <a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt my-1"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 pl-1">
        <div class="card">
            <div class="card-header">
                Occupancies
                <button @click="openAddModal()" type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add Occupancy</button>
            </div>
            <div class="card-body">
                <table class="table table-sm p-0">
                    <thead class="thead-dark p-0">
                        <th class="py-0" scope="col">Occupancy range</th>
                        <th class="py-0" scope="col">Adjustment</th>
                        <th class="py-0" scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="occu in occup" :key="occu.id">
                            <td>{{occu.occupancy}}</td>
                            <td>{{occu.adjustment}}</td>
                            <td>
                                <a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a>
                                <a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addRate" tabindex="-1" role="dialog" aria-labelledby="addRate" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode" class="modal-title">Edit Room</h5>
                        <h5 v-show="!editMode" class="modal-title" id="editreserve">Add Occupancy Range</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateRoom() : createOcc()">
                    <div class="modal-body">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="occupancy">Occupancy Percentage</label>
                                        <input v-model="occup_form.occupancy" min="1" max="100" type="number" class="form-control"
                                        :class="{ 'is-invalid': occup_form.errors.has('occupancy') }" id="occupancy" placeholder="Occupancy Percentage" />
                                        <has-error :form="occup_form" field="occupancy"></has-error>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="adjustment">Floor</label>
                                            <input v-model="occup_form.adjustment"  type="number" class="form-control" id="adjustment" placeholder="Range" required/>
                                        </div>
                                </div>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-sm btn-primary">Add Occupancy Range</button>
                        <button v-show="editMode" type="submit" class="btn btn-sm btn-primary">Edit Occupancy Range</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


</div>

</template>

<script>
     export default {
        data(){
            return{
                editMode: false,
                rate:[],
                rate_form: new Form({
                    //room_id: '',
                }),
                occup:[],
                occup_form: new Form({
                    id: '',
                    occupancy: '',
                    adjustment: '',
                }),
            }
        },
        methods:{
            openEditModal(data){
                this.editMode = true;
                $('#addRate').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#addRate').modal('show')
            },
            loadOcc_Rate(){
                this.$Progress.start();
                axios.get('api/occu').then(({data})=>(this.occup = data.data));
                axios.get('api/rate').then(({data})=>(this.rate = data.data));
                this.$Progress.finish();
            },
            createOcc(){
                this.$Progress.start();
                this.occup_form.post('api/occu').then(()=>{
                    Fire.$emit('occCreated');
                    $('#addRate').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Room added successfully'
                    })
                    this.$Progress.finish();
                    this.loadReservationsCont();
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            remove(id){

            },
            update(){

            },

        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.loadOcc_Rate();
            Fire.$on('occCreated',()=>{
                 this.loadOcc_Rate();
        });
        }
    }
</script>
