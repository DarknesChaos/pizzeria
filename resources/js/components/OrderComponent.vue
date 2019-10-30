<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pedidos</div>

                <div class="card-body">
                    <div class="pull-right">
                        <router-link class="btn btn-xs btn-outline-primary" v-bind:to="{path: '/create-order'}">
                            Nuevo pedido
                        </router-link>
                        <br><br>
                    </div>

                    <div id="isAdmin">
                        <table class="table table-bordered table-striped text-center" id="orders_table">
                            <thead>
                            <tr>
                                <th scope="col">Numero pedido</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Total</th>
                                <th scope="col">Empleado</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td v-text="order.id"></td>
                                <td v-text="order.date"></td>
                                <td v-text="order.total"></td>
                                <td v-text="order.employee"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datatable from 'datatables'
    export default {
        data() {
            return {
                orders: [],
            }
        },
        methods: {
            myTable() {
                $(function () {
                    $("#orders_table").DataTable();
                });
            },

            getOrders() {
                let url = '/orders';
                axios.get(url).then((response) => {
                    this.orders = response.data;
                    this.myTable();
                }).catch((error) => {
                    console.log("Something it's wrong, please try again!", error);
                });
            },

            userLogged() {
                let url = '/userAuth';
                axios.get(url).then((response) => {
                    if(response.data === 'Administrator'){
                        $('#isAdmin').show();
                    }else{
                        $('#isAdmin').hide();
                    }
                }).catch((error) => {
                    console.log("Something it's wrong, please try again!", error);
                });
            }
        },
        mounted() {
            this.userLogged();
            this.getOrders();
        }
    }
</script>

<style scoped>

</style>
