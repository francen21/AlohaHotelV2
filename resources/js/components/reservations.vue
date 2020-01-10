<template>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-black float-left">Reservation</h3>
                <button type="button" class="btn btn-info float-right" @click="openAddModal">
                    <i class="fas fa-plus"></i> Add New
                </button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm p-0 m-2">
                <thead class="thead-dark">
                    <th scope="col">Reservation Id</th>
                    <th scope="col">Room Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Id Type</th>
                    <th scope="col">Id Number</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody>
                    <tr v-for="res in reservations" :key="res.reservation_id">
                        <td>{{res.reservation_id}}</td>
                        <td>{{res.room.room_number}}</td>
                        <td>{{res.guest.guest_name | upText}}</td>
                        <td>{{res.guest.guest_type}}</td>
                        <td>{{res.guest.guest_number}}</td>
                        <td>{{res.guest.created_at}}</td>
                        <td>
                            <button type="submit" class="btn btn-primary" @click="openViewModal(res.reservation_id)"><a title="View" data-toggle="tooltip"><i class="fas fa-eye"></i></a></button>
                            <button type="submit" class="btn btn-success" @click="openEditModal(res.reservation_id)" ><a title="View" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                            <button type="submit" class="btn btn-danger" @click="cancelReservation(res.reservation_id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
        <ADD ref="childADD"></ADD>
        <EDIT ref="childEDIT"></EDIT>
    </div>
</div>



</template>

<script>
import ADD from './Modals/reservations/addreservation.vue';
import EDIT from './Modals/reservations/editreservation.vue';
    export default {
        data() {
            return {
                reservations:{},
                resid:'',
            }
        },
        components: {
            ADD,
            EDIT
        },
        methods:{
            openEditModal(res){
                this.$refs.childEDIT.editMode = true;
                this.$refs.childEDIT.loadReservation(res);
                $('#editreserve').modal('show');
            },
            openViewModal(res){
                this.$refs.childEDIT.editMode = false;
                this.$refs.childEDIT.loadReservation(res);
                $('#editreserve').modal('show');
            },
            openAddModal(){
                let child = this.$refs.childADD.form;
                child.reset();
                $('#reserve').modal('show')
            },
            cancelReservation(id){
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
                            axios.delete('api/reservation/'+id).then(()=>{

                                    Swal.fire(
                                    'Deleted!',
                                    'Reservation has been canceled.',
                                    'success'
                                    )
                                    Fire.$emit('resCreated');

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
            loadReservationsOnce(){
                this.$Progress.start();
                axios.get('api/reservation')
                .then(({data})=>(this.reservations = data.data));
                this.$Progress.finish();
            },
            loadReservationsCont(){

                axios.get('api/reservation')
                .then(({data})=>(this.reservations = data.data));

            },

        },
        created() {
            this.loadReservationsOnce();
            Fire.$on('resCreated',()=>{
                this.loadReservationsOnce();
            });
            //setInterval(()=>this.loadReservationsCont(),5000);
        },
    }
</script>
