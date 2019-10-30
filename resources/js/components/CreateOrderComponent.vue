<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nuevo Pedido</div>

                <div class="card-body">
                    <form v-on:submit.prevent="save" class="needs-validation" novalidate>
                        <div class="form-group row">
                            <label for="pizza_id" class="col-sm-2 col-form-label">Pizza</label>
                            <div class="col-sm-10">
                                <select :class="['form-control', allErrors.pizza_id ? 'is-invalid' : '']"
                                        name="pizza_id" id="pizza_id" v-model="order.pizza_id"
                                        @change="getSisesPrice" autofocus="autofocus">
                                    <option value="" selected disabled>Selecciona...</option>
                                    <option v-for="pizza in pizzas" v-bind:value="pizza.id">
                                        {{ pizza.name }}
                                    </option>
                                </select>
                                <span v-if="allErrors.pizza_id" :class="['invalid-feedback']" role="alert">
                                    <strong>{{ allErrors.pizza_id[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="size" class="col-sm-2 col-form-label">Tamaño</label>
                            <div class="col-sm-10">
                                <select name="size" id="size" v-model="order.size"
                                        :class="['form-control', allErrors.size ? 'is-invalid' : '']">
                                    <option value="" selected disabled>Selecciona...</option>
                                    <option v-for="size in sizes" v-bind:value="size.id">
                                        {{ size.size }}
                                    </option>
                                </select>
                                <span v-if="allErrors.size" :class="['invalid-feedback']" role="alert">
                                    <strong>{{ allErrors.size[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Precio</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="price" id="price" v-model="order.price" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" id="quantity" v-model="order.quantity"
                                       @change="getTotal" :class="['form-control', allErrors.quantity ? 'is-invalid' : '']">
                                <span v-if="allErrors.quantity" :class="['invalid-feedback']" role="alert">
                                    <strong>{{ allErrors.quantity[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Fecha</label>
                            <div class="col-sm-10">
                                <input type="text" :class="['form-control', allErrors.date ? 'is-invalid' : '']"
                                       name="date" id="date" pattern="\d{4}/\d{1,2}/\d{1,2}" v-model="order.date">
                                <span v-if="allErrors.date" :class="['invalid-feedback']" role="alert">
                                    <strong>{{ allErrors.date[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-2 col-form-label">Total</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="total" id="total" v-model="order.total" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 text-center">
                                <button type="submit" id="btnSave" class="btn btn-outline-success">Crear</button>
                                <router-link class="btn btn-outline-danger" v-bind:to="'/'">Cancel</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

            return {
                pizzas: [],
                sizes: [],
                order: {date: '', total: '', price: '', size: '', quantity: '', pizza_id: ''},
                allErrors: [],
                success: false,
            }
        },
        methods: {
            getPizzas(){
                let url = '/getPizzas';
                axios.get(url).then((response) => {
                    this.pizzas = response.data;
                }).catch((error) => {
                    console.log("Something it's wrong, please try again!", error);
                });
            },

            getSisesPrice(){
                let url = '/getSize/'+this.order.pizza_id;
                axios.get(url).then((response) => {
                    this.sizes = response.data;
                }).catch((error) => {
                    console.log("Something it's wrong, please try again!", error);
                });

                let uri = '/getPrice/'+this.order.pizza_id;
                axios.get(uri).then((resp) => {
                    this.order.price = resp.data;
                }).catch((error) => {
                    console.log("Something it's wrong, please try again!", error);
                });
            },

            getTotal(event){
                this.order.sale_quantity = event.target.value;
                this.order.total = this.order.price * this.order.sale_quantity;
                this.order.total = this.order.total.toFixed(2);
            },

            save() {
                let url = '/orders';
                axios.post(url, this.order).then((response) => {
                    this.$router.push({name: 'orders'});

                    this.order = {date: '', total: '', price: '', size: '', quantity: '', pizza_id: ''};
                    this.success = true;
                    console.log("The order has been created successfully!");
                }).catch((error) => {
                    this.allErrors = error.response.data.errors;
                    this.success = false;
                    console.log("Something it's wrong, please try again!", error);
                });
            }
        },
        mounted() {
            this.getPizzas();
        }
    }
</script>

<style scoped>

</style>
