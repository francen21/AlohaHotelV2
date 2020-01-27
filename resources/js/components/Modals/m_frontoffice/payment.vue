<template>
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="payment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" v-bind:class="{ 'modal-sm': !checkedin , 'modal-xl' : checkedin}">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title float-left text-primary" id="payment">Payments</h5>
                    <button @click="create()" type="button" class="btn btn-info add-new float-right">
                        <i class="fa fa-plus"></i> Pay
                    </button>
                </div>
                <div class="modal-body">
                    <b-table
                        :striped="striped"
                        :bordered="bordered"
                        :outlined="outlined"
                        :small="small"
                        :items="items"
                        :fields="fields"
                        :head-variant="headVariant"
                    ></b-table>
                </div>
                <div class="modal-footer py-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
    export default {
        data(){
            return{
                fields: ['payment_id', 'amount', 'payment_date'],
                items: [
                { payment_id: 40, amount: 'php 2,096', payment_date: '2020-01-18 05:26:29' },
                { payment_id: 40, amount: 'php 2,096', payment_date: '2020-01-18 05:26:29' },
                { payment_id: 40, amount: 'php 2,096', payment_date: '2020-01-18 05:26:29' },
                ],
                striped: true,
                bordered: true,
                outlined: true,
                small: true,
                headVariant: "light",
                checkedin: false,
                reservations:{},
                form: new Form({
                    room_number:'',
                })
            }
        },
        methods:{
            loadData(){
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
