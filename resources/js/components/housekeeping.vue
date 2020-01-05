<template>
    <div class="card">
    <div class="card-header">
        <h3 class="m-0 font-weight-bold text-primary">House Keeping</h3>
        <button type="button" class="btn btn-info add-new float-right"><i class="fa fa-plus"></i> Add New</button>
    </div>
    <div class="card-body">
        <table class="table table-sm p-0 m-2">
            <thead class="thead-dark">
                <th scope="col">Room Number</th>
                <th scope="col">Room Type</th>
                <th scope="col">Floor</th>
                <th scope="col">Tariff</th>
                <th scope="col">Status</th>
                <th scope="col">Charges</th>
                <th scope="col">Service</th>
            </thead>
            <tbody>
                <tr v-for="room in rooms" :key="room.room_id">
                    <td>{{room.room_number}}</td>
                    <td>{{room.room_type  }}</td>
                    <td>{{room.room_floor }}</td>
                    <td>{{room.room_tarrif}}</td>
                    <td>{{room.room_status}}</td>
                    <td>
                        <button class="btn btn-sm btn-success"  title="Add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-sm btn-danger"   title="Edit" data-toggle="tooltip"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-sm btn-info"     title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                    </td>
                     <td>
                        <button @click="update(room, '3')" class="btn btn-sm btn-success" title="Available" data-toggle="tooltip"><i class="fa fa-plus"></i> Available</button>
                        <button @click="update(room, '2')" class="btn btn-sm btn-danger" title="Cleaning" data-toggle="tooltip"><i class="fas fa-broom"></i> Cleaning</button>
                        <button @click="update(room, '1')" class="btn btn-sm btn-info" title="Inspection" data-toggle="tooltip"><i class="fas fa-quidditch"></i> Inspection</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
</template>
<script>
     export default {
        data(){
            return{
                rooms:{},
                room_form: new Form({
                    room_id: '',
                    room: '',
                    room_number: '',
                    room_type: '',
                    room_floor: '',
                    room_tarrif: ''
                })

            }
        },
        methods:{
            openEditModal(){
                this.editMode = true;
            },
            openAddModal(){
                this.editMode = false;
            },
            load(){
                this.$Progress.start();
                axios.get('api/house')
                    .then(({data})=>(this.rooms = data.data));
                this.$Progress.finish();
            },
            create(){

            },
            remove(id){

            },
            update(room, service1){
                if (service1 == 3) {
                    room.room_status = 'Available';
                }else if(service1 == 2){
                    room.room_status = 'Cleaning';
                }
                 else {
                    room.room_status = 'For Inspection';
                }
                console.log(room.room_status);
                console.log(service1);
                this.room_form.fill(room);
                this.$Progress.start();
                this.room_form.put('api/house/'+this.room_form.room_id).then(()=>{
                    Fire.$emit('romCreated');
                    this.room_form.reset();
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
            console.log('Component mounted.')
        },
        created(){
            this.load()
        }
    }
</script>
