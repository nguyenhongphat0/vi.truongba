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
                        <input @input="change" type="text" class="flat" v-model="product.customer_id" placeholder="No customer" title="Customer"><br>
                        <input @input="change" type="text" class="flat" v-model="product.secret_key" placeholder="No key" title="Key"><br>
                        <input @input="change" type="text" class="flat" v-model="product.status" placeholder="No status" title="Status"><br>
                        <textarea @input="change" class="flat" v-model="product.secret" placeholder="No secret" title="Secret" /><br>
                    </div>
                    </v-card-title>
                    <v-card-actions>
                        <div style="margin-left: auto" class="grey--text">
                            <v-btn v-if="product.id && changed && admin" class="red white--text" @click="updateProduct">Update</v-btn>
                            <v-btn v-if="!product.id && admin" class="red white--text" @click="createProduct">Create</v-btn>
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

    constructor() {
        super();
        this.admin = localStorage.getItem('admin') == '1';
    }

    fetchProduct(id: string) {
        if (id == 'new') {
            this.product = {
                name: ''
            } as Product;
            return;
        }
        fetch(`/api/product/get.php?id=${id}`)
            .then(res => res.json() as Promise<Product>)
            .then(product => {
                this.product = product;
            });
    }

    show(message: string) {
        this.message = message;
        this.showMessage = true;
    }

    change() {
        this.changed = true;
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