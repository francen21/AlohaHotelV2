<template>

</template>

<script>
    export default {
        data(){
            return{
                name:'', items:[], perPage: 10, currentPage: 1, headVariant: 'light', filter: null, file: null, modalShow: false, fields: [
                    { key: 'category', label: 'Category' , sortable: true},
                    { key: 'code', label: 'Code' },
                    { key: 'price', label: 'Price' },
                    { key: 'created_at', label: 'Created' ,sortable: true},
                    'Actions',
                    ],
                stocks:{},
                roomid:'',
                guest_id:'',
                charge: new Form({
                    id: '',
                    room_id: '',
                    guest_id: '',
                    code: '',
                    category: '',
                    qty: '',
                    price: '',
                }),
                stock: new Form({
                    inventory_id: '',
                    item_category: '',
                    item_code: '',
                    item_quantity: '',
                    item_price: '',
                    created_at: '',
                    updated_at: '',
                })
            }
        },
        computed: {
            rows() {
                return this.items.length;
            },
            totalprice: function () {
            var x = this.stock.item_price * this.charge.qty;
                this.charge.code = this.stock.item_code;
                this.charge.price = x;
                return x;
            }
        },
        methods:{
            load(){
                this.$Progress.start();
                this.$Progress.finish();
            },
            create(){
                this.$Progress.start();
                this.charge.room_id = this.roomid;
                this.charge.guest_id = this.guest_id;
                this.charge.category = this.stock.item_category;
                this.charge.post('api/charge').then(()=>{
                    this.items.push(this.charge);
                    Fire.$emit('itmCreated');
                    this.charge.reset();
                    Toast.fire({
                        icon: 'success',
                        title: 'Guest charged'
                    })
                    this.$Progress.finish();
                    Fire.$emit('itmCreated');
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something is not right.'
                    })
                    this.$Progress.fail()
                });
            },
            remove(id,index){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove charge'
                    }).then((result) => {

                        if (result.value) {
                            axios.delete('api/charge/'+id).then(()=>{
                                    this.items.splice(index);
                                    Fire.$emit('itmCreated');
                                    Swal.fire(
                                    'Deleted!',
                                    'Charge deleted.',
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

            }
        },
        mounted() {
        },
        created(){
            axios.get('api/inventory').then(({data})=>(this.stocks = data.data));
        }
    }
</script>
