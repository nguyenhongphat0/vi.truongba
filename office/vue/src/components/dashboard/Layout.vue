<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs6 md4 lg3 xl2>
                <Stat v-if="customers"
                    :cover="'<b style=\'font-size: 80px\'>'+customers.length+'</b> customers'"
                    img="https://ucarecdn.com/73d99649-76f3-49fa-997a-720a5ba7c010/"
                    button="View customer"
                    to="/customer"
                    icon="account_box"
                    color="red"/>
            </v-flex>
            <v-flex xs6 md4 lg3 xl2>
                <Stat v-if="products"
                    :cover="'<b style=\'font-size: 80px\'>'+products.length+'</b> products'"
                    img="https://3.bp.blogspot.com/-0qdhsdCNBcU/VWVtLSFDmpI/AAAAAAAAAvg/DT7dMmlIpwg/s1600/io15material.png"
                    button="View product"
                    to="/product"
                    icon="public"
                    color="blue"/>
            </v-flex>
            <v-flex xs6 md4 lg3 xl2>
                <Stat 
                    cover="<b style='font-size: 80px'>0</b> tasks"
                    img="https://img.freepik.com/free-vector/elegant-green-geometric-polygon-background_1035-13146.jpg?size=338&ext=jpg"
                    button="View task"
                    icon="account_box"
                    color="green"/>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import Stat from '@/components/shared/Stat.vue';
import Customer from '../../models/customer';
import Product from '../../models/product';

@Component({
    components: {
        Stat
    }
})
export default class Layout extends Vue{
    customers: Customer[] | null = null;
    products: Product[] | null = null;

    constructor() {
        super();
        this.fetchCustomers();
        this.fetchProducts();
    }
    
    async fetchCustomers() {
        this.customers = await fetch(`/api/customer`)
        .then(res => res.json() as Promise<Customer[]>)
        .catch(error => []);
    }

    async fetchProducts() {
        this.products = await fetch(`/api/product`)
        .then(res => res.json() as Promise<Product[]>)
        .catch(error => []);
    }
}
</script>
