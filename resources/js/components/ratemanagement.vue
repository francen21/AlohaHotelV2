<template>

<div class="container">

    <div class="row p-2">
    <div class="col-6 pr-1">
        <div class="card">
            <div class="card-header">
                Base Rates
                <button @click="openRate()" type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add Rate
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
                        <tr v-for="rate in rates" :key="rate.id" >
                            <td>{{rate.type}}</td>
                            <td>&#x20B1; {{rate.rate}}</td>
                            <td>
                                <button type="submit" class="btn btn-success" @click="editRate(rate)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                                <button type="submit" class="btn btn-danger" @click="removeRate(rate.id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
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
                <button @click="openOccu()" type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add Occupancy</button>
            </div>
            <div class="card-body">
                <table class="table table-sm p-0">
                    <thead class="thead-dark p-0">
                        <th class="py-0" scope="col">Occupancy range</th>
                        <th class="py-0" scope="col">Adjustment</th>
                        <th class="py-0" scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="occu in occups" :key="occu.id">
                            <td>{{occu.occupancy}}</td>
                            <td>{{occu.adjustment}}</td>
                            <td>
                                <button type="submit" class="btn btn-success" @click="editOccu(occu)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                                <button type="submit" class="btn btn-danger" @click="removeOccu(occu.id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
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

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 v-show="editMode && occupancy" class="modal-title">Edit Occupancy</h5>
                        <h5 v-show="!editMode && occupancy" class="modal-title" id="editreserve">Add Occupancy Range</h5>
                        <h5 v-show="editMode && !occupancy" class="modal-title">Edit Rate</h5>
                        <h5 v-show="!editMode && !occupancy" class="modal-title" id="editreserve">Add Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? (!occupancy ? updateRate() : updateOccu() ):(!occupancy ? createRate(): createOccu())">
                    <div class="modal-body">

                                <div class="form-row" v-if="occupancy">
                                    <div class="form-group col-md-12">
                                        <label for="occupancy">Occupancy Percentage</label>
                                        <input v-model="occup_form.occupancy" min="1" max="100" type="number" class="form-control"
                                        :class="{ 'is-invalid': occup_form.errors.has('occupancy') }" id="occupancy" placeholder="Occupancy Percentage" />
                                        <has-error :form="occup_form" field="occupancy"></has-error>
                                    </div>
                                </div>
                                <div class="form-row" v-if="occupancy">
                                        <div class="form-group col-md-12">
                                            <label for="adjustment">Adjustment</label>
                                            <input v-model="occup_form.adjustment" min="1"  type="number" class="form-control" id="adjustment" placeholder="Range" required/>
                                        </div>
                                </div>
                                <div class="form-row" v-if="!occupancy">
                                        <div class="form-group col-md-12">
                                            <label for="type">Room Type</label>
                                            <input v-model="rate_form.type"  type="text" class="form-control" id="type" required/>
                                        </div>
                                </div>
                                <div class="form-row" v-if="!occupancy">
                                        <div class="form-group col-md-12">
                                            <label for="rate">Rate</label>
                                            <input v-model="rate_form.rate" min="1" type="number" class="form-control" id="rate" required/>
                                        </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="cap">Room Capacity</label>
                                    <input v-model="rate_form.capacity" min="2" type="number" class="form-control" id="cap" required/>
                                </div>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode && occupancy" type="submit" class="btn btn-sm btn-primary">Add Occupancy Range</button>
                        <button v-show="editMode && occupancy" type="submit" class="btn btn-sm btn-primary">Edit Occupancy Range</button>
                        <button v-show="!editMode && !occupancy" type="submit" class="btn btn-sm btn-primary">Add Rate</button>
                        <button v-show="editMode && !occupancy" type="submit" class="btn btn-sm btn-primary">Edit Rate</button>
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
                occupancy:false,
                rates:{},
                occups:{},
                rate_form: new Form({
                    id: '',
                    type: '',
                    capacity: '',
                    rate: '',
                }),
                occup_form: new Form({
                    id: '',
                    occupancy: '',
                    adjustment: '',
                }),
            }
        },
        methods:{
            openRate(){
                this.editMode = false;
                this.occupancy = false;
                $('#add').modal('show');
            },
            editRate(data){
                this.editMode = true;
                this.occupancy = false;
                this.rate_form.fill(data);
                $('#add').modal('show');
            },
            openOccu(){
                this.editMode = false;
                this.occupancy = true;
                $('#add').modal('show');
            },
            editOccu(data){
                this.editMode = true;
                this.occupancy = true;
                this.occup_form.fill(data);
                $('#add').modal('show');
            },
            load(){
                axios.get('api/occu').then(({data})=>(this.occups = data.data));
                axios.get('api/rate').then(({data})=>(this.rates = data.data));
            },
            createOccu(){
                this.$Progress.start();
                this.occup_form.post('api/occu').then(()=>{
                    Fire.$emit('created');
                    $('#add').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Occupation added successfully'
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
            createRate(){
                this.$Progress.start();
                this.rate_form.post('api/rate').then(()=>{
                    Fire.$emit('created');
                    $('#add').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'Rate added successfully'
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
            removeOccu(id){
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
                            axios.delete('api/occu/'+id).then(()=>{

                                    Swal.fire(
                                    'Deleted!',
                                    'Occupation has been removed.',
                                    'success'
                                    )
                                    Fire.$emit('created');

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
            removeRate(id){
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
                            axios.delete('api/rate/'+id).then(()=>{

                                    Swal.fire(
                                    'Deleted!',
                                    'Rate has been removed.',
                                    'success'
                                    )
                                    Fire.$emit('created');

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
            updateOccu(){
                this.$Progress.start();
                this.occup_form.put('api/occu/'+ this.occup_form.id).then(()=>{
                    Fire.$emit('created');
                    $('#add').modal('hide')
                    this.occup_form.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Occupancy Updated'
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
            updateRate(){
                this.$Progress.start();
                this.rate_form.put('api/rate/'+ this.rate_form.id).then(()=>{
                    Fire.$emit('created');
                    $('#add').modal('hide')
                    this.rate_form.reset();
                    Toast.fire({
                            icon: 'success',
                            title: 'Rate Updated'
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

        },
        created(){
            this.load();
            Fire.$on('created',()=>{
                 this.load();
        });
        }
    }
</script>
