<template>
    <div class="container">
        <div class="card">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold float-left text-primary">User Log</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm p-0 m-2">
                <thead class="thead-dark">
                    <th scope="col">No</th>
                    <th scope="col">Url</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Worth</th>
                </thead>
                <tbody>
                    <tr v-for="stock in stocks" :key="stock.stock_id">
                        <td>{{stock.inventory_id}}</td>
                        <td>{{stock.item_code}}</td>
                        <td>{{stock.item_category}}</td>
                        <td>{{stock.item_quantity}}</td>
                        <td>{{stock.item_price | toCurrency}}</td>
                        <td>{{(stock.item_quantity * stock.item_price) | toCurrency}}</td>
                    </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{

            }
        },
        methods:{
            openEditModal(data){
                this.data_form.fill(data);
                this.editMode = true;
                $('#Modal').modal('show');
            },
            openAddModal(){
                this.editMode = false;
                $('#Modal').modal('show')
            },
            load(){
                this.$Progress.start();
                axios.get('api/room')
                    .then(({data})=>(this.data_form = data.data));
                this.$Progress.finish();
            },
            loadCont(){
                axios.get('api/room')
                    .then(({data})=>(this.data_form = data.data));
            },
            create(){

            },
            remove(id){

            },
            update(){

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){

        }
    }
</script>
