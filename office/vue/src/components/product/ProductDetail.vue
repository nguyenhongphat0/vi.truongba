<template>
    <div>
        <div v-if="product">
            <div v-if="product.name != null">
                <v-card class="card">
                    <v-card-media :src="product.image" height="40vh" @mouseover="editImage = true" @mouseout="editImage = false" style="cursor: pointer">
                    <div style="margin: auto;">
                        <input @input="change" v-if="editImage" type="text" class="flat" v-model="product.image" placeholder="No image" title="Image" style="text-align: center"><br>
                    </div>
                    </v-card-media>
                    <v-card-title primary-title>
                    <div style="width: 100%">
                        <h3 class="headline mb-0">
                            <input @input="change" type="text" class="flat" v-model="product.name" placeholder="No name" title="Name">
                        </h3>
                        <textarea @input="change" class="flat" v-model="product.description" placeholder="No description" title="Description" /><br>
                        <v-select data-app @input="change" :items="customers" label="Customer" item-text="name" item-value="id" v-model="product.customer_id" :disabled="!admin"></v-select>
                        <input @input="change" type="text" class="flat" v-model="product.status" placeholder="No status" title="Status" :class="product.status.toLowerCase()"><br>
                        <div v-if="admin">
                            <input @input="change" type="text" class="flat" v-model="product.secret_key" placeholder="No key" title="Key"><br>
                            <textarea @input="change" class="flat" v-model="product.secret" placeholder="No secret" title="Secret" /><br>
                        </div>
                        <div v-if="!admin && product.secret">
                            <pre>{{product.secret}}</pre>
                        </div>
                    </div>
                    </v-card-title>
                    <v-card-actions>
                        <div style="margin-left: auto" class="grey--text">
                            <v-btn v-if="product.id && changed && admin" class="red white--text" @click="updateProduct">Update</v-btn>
                            <v-btn v-if="!product.id && admin" class="red white--text" @click="createProduct">Create</v-btn>
                            <input type="password" v-if="!admin" class="flat" v-model="product.secret_key" @keyup.enter="showSecret" placeholder="Enter secret key" style="display: inline; width: 150px;">
                            <v-btn v-if="!admin" class="red white--text" @click="showSecret">Show secret</v-btn>
                            {{product.date_created}}
                        </div>
                    </v-card-actions>
                </v-card>
                <v-snackbar
                    v-model="showMessage"
                    bottom
                    >
                        {{ message }}
                    <v-btn
                        color="red"
                        flat
                        @click="showMessage = false"
                    >
                        Close
                    </v-btn>
                    </v-snackbar>
            </div>
            <div v-if="product.name == null">
                <h1>No product found!</h1>
            </div>
        </div>
    </div>    
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Card from '@/components/shared/Card.vue';
import Product from '../../models/product';
import { Prop, Watch } from 'vue-property-decorator';
import Customer from '../../models/customer';

@Component({
    components: {
        Card
    }
})
export default class ProductDetail extends Vue {
    product: Product | null = null;
    editImage: boolean = false;
    showMessage: boolean = false;
    message: string = '';
    changed: boolean = false;
    admin: boolean = false;
    customers: Customer[];

    constructor() {
        super();
        this.admin = localStorage.getItem('admin') == '1';
        this.fetchCustomers();
    }

    fetchProduct(id: string) {
        if (id == 'new') {
            this.product = {
                name: ''
            } as Product;
            return;
        }
        fetch(`/api/product/get.php?id=${id}`, {
            credentials: 'include'
        })
            .then(res => res.json() as Promise<Product>)
            .then(product => {
                this.product = product;
            });
    }

    async fetchCustomers() {
        this.customers = await fetch(`/api/customer`)
        .then(res => res.json() as Promise<Customer[]>)
        .catch(error => []);
    }

    show(message: string) {
        this.message = message;
        this.showMessage = true;
    }

    change() {
        this.changed = true;
    }

    async showSecret() {
        this.product.secret = await fetch(`/api/product/secret.php?id=${this.product.id}&key=${encodeURIComponent(this.product.secret_key)}`)
        .then(res => {
            if (res.status == 200) {
                return res.text()
            } else {
                throw "Wrong secret key!"
            }
        })
        .catch(error => {
            this.message = error;
            this.showMessage = true;
            return '';
        })
    }

    updateProduct() {
        fetch(`/api/product/update.php`, {
            method: "PUT",
            credentials: "include",
            body: JSON.stringify(this.product)
        })
        .then(res => {
            console.log(res);
            if (res.ok) {
                return res.json() as Promise<boolean>
            } else if (res.status == 403) {
                localStorage.setItem('admin', 'false');
                throw new Error("Operation not permited");
            } else {
                throw new Error("Name must not be null!");
            }
        })
        .then(res => {
            if (res == false) {
                throw new Error("Error updating product detail. Something wrong with your database!");
            } else {
                this.show(`${this.product.name}'s info updated!`);
                this.changed = false;
                this.$emit('refreshTable');
            }
        })
        .catch(error => {
            this.show(error.message);
        });
    }

    createProduct() {
        fetch(`/api/product/insert.php`, {
            method: "POST",
            credentials: "include",
            body: JSON.stringify(this.product)
        })
        .then(res => {
            if (res.ok) {
                return res.json() as Promise<boolean>
            } else if (res.status == 403) {
                localStorage.setItem('admin', 'false');
                throw new Error("Operation not permited");
            } else {
                throw new Error("Name must not be null!");                
            }
        })
        .then(res => {
            if (res == false) {
                throw new Error("Error updating product detail. Something wrong with your database!");
            } else {
                this.show(`Product ${this.product.name} created successfully`);
                this.$emit('refreshTable');
            }
        })
        .catch(error => {
            this.show(error.message);
        });
    }

    created() {
        this.fetchProduct(this.$route.params.id);
    }

    @Watch('$route')
    routeChanged (to, from) {
        this.fetchProduct(to.params.id);
    }
}
</script>

<style>
pre {
    font-family: inherit !important;
    white-space: pre-wrap !important;
    border-top: 1px solid firebrick !important;
    margin-top: 20px !important;
    max-height: 40vh;
    overflow-y: scroll;
}
.done, complete, .completed, .finish, .finished, .success {
    color: darkseagreen;
}
input.warning, input.danger, input.urgent {
    color: firebrick;
}
.menu__content {
    box-shadow: none !important;
    position: static !important;
}
</style>
