<template>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-black float-left">Reservation</h3>
                <button type="button" title="Add Reservation" class="btn btn-info float-right" @click="openAddModal">
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
                            <button type="submit" class="btn btn-primary" @click="openViewModal(res)"><a title="View" data-toggle="tooltip"><i class="fas fa-eye"></i></a></button>
                            <button type="submit" class="btn btn-success" @click="openEditModal(res)" ><a title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></a></button>
                            <button type="submit" class="btn btn-danger" @click="cancelReservation(res.reservation_id)"><a title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
        <ADD ref="childADD"></ADD>
    </div>
</div>



</template>

<script>
import ADD from './Modals/reservations/addreservation.vue';
    export default {
        data() {
            return {
                reservations:{},
                resid:'',
            }
        },
        components: {
            ADD,
        },
        methods:{
            openEditModal(res){
                this.$refs.childADD.editMode = true;
                this.$refs.childADD.viewMode = false;
                this.$refs.childADD.reservationData.fill(res);
                this.$refs.childADD.room.fill(res.room);
                this.$refs.childADD.guest.fill(res.guest);

                $('#reserve').modal('show');
            },
            openViewModal(res){
                this.$refs.childADD.editMode = false;
                this.$refs.childADD.viewMode = true;
                this.$refs.childADD.reservationData.fill(res);
                this.$refs.childADD.room.fill(res.room);
                this.$refs.childADD.guest.fill(res.guest);
                $('#reserve').modal('show');
            },
            openAddModal(){
                this.$refs.childADD.editMode = false;
                this.$refs.childADD.viewMode = false;
                this.$refs.childADD.reserve = true;
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
                .then(({data})=>(this.reservations = data));
                this.$Progress.finish();
            },
            loadReservationsCont(){
                axios.get('api/reservation')
                .then(({data})=>(this.reservations = data));

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
