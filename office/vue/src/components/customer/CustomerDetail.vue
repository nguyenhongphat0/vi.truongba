<template>
    <div>
        <div v-if="customer.name != null">
            <v-card class="card">
                <v-card-media :src="customer.avatar" height="40vh" @mouseover="editAvatar = true" @mouseout="editAvatar = false" style="cursor: pointer">
                <div style="margin: auto;">
                    <input @input="change" v-if="editAvatar" type="text" class="flat" v-model="customer.avatar" placeholder="No avatar" title="Avatar" style="text-align: center"><br>
                </div>
                </v-card-media>
                <v-card-title primary-title>
                <div style="width: 100%">
                    <h3 class="headline mb-0">
                        <input @input="change" type="text" class="flat" v-model="customer.name" placeholder="No name" title="Name" style="width: unset">&nbsp;
                        <div style="float: right">
                            <a class="red--text" :href="'tel:'+customer.phone" target="_blank"><v-icon>phone</v-icon></a>
                            <a class="red--text" :href="'mailto:'+customer.email" target="_blank"><v-icon>email</v-icon></a>
                        </div>
                    </h3>
                    <input @input="change" type="text" class="flat" v-model="customer.organization" placeholder="No organization" title="Organization"><br>
                    <input @input="change" type="text" class="flat" v-model="customer.phone" placeholder="No phone" title="Phone"><br>
                    <input @input="change" type="text" class="flat" v-model="customer.email" placeholder="No email" title="Email"><br>
                    <input @input="change" type="text" class="flat" v-model="customer.address" placeholder="No address" title="Address"><br>
                    <textarea @input="change" class="flat" v-model="customer.description" placeholder="No description" title="Description" /><br>
                </div>
                </v-card-title>
                <v-card-actions>
                    <div style="margin-left: auto" class="grey--text">
                        <v-btn v-if="customer.id && changed" class="red white--text" @click="updateCustomer">Update</v-btn>
                        <v-btn v-if="!customer.id" class="red white--text" @click="createCustomer">Create</v-btn>
                        {{customer.date_created}}
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
        <div v-if="customer.name == null">
            <h1>No customer found!</h1>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Card from '@/components/shared/Card.vue';
import Customer from '../../models/customer';
import { Prop, Watch } from 'vue-property-decorator';

@Component({
    components: {
        Card
    }
})
export default class CustomerDetail extends Vue {
    customer: Customer | null = null;
    editAvatar: boolean = false;
    showMessage: boolean = false;
    message: string = '';
    changed: boolean = false;

    constructor() {
        super();
    }

    fetchCustomer(id: string) {
        if (id == 'new') {
            this.customer = {
                name: ''
            } as Customer;
            return;
        }
        fetch(`/api/customer/get.php?id=${id}`)
            .then(res => res.json() as Promise<Customer>)
            .then(customer => {
                this.customer = customer;
            });
    }

    show(message: string) {
        this.message = message;
        this.showMessage = true;
    }

    change() {
        this.changed = true;
    }

    updateCustomer() {
        fetch(`/api/customer/update.php`, {
            method: "PUT",
            credentials: "include",
            body: JSON.stringify(this.customer)
        })
        .then(res => {
            if (res.ok) {
                return res.json() as Promise<boolean>
            } else {
                throw new Error("Name must not be null!");
            }
        })
        .then(res => {
            if (res == false) {
                this.show("Error updating customer detail. Something wrong with your database!");
            } else {
                this.show(`${this.customer.name}'s info updated!`);
                this.changed = false;
                this.$emit('refreshTable');
            }
        })
        .catch(error => {
            this.show("Name must not be null!");
        });
    }

    createCustomer() {
        fetch(`/api/customer/insert.php`, {
            method: "POST",
            credentials: "include",
            body: JSON.stringify(this.customer)
        })
        .then(res => {
            if (res.ok) {
                return res.json() as Promise<boolean>
            } else {
                throw new Error("Name must not be null!");
            }
        })
        .then(res => {
            if (res == false) {
                this.show("Error updating customer detail. Something wrong with your database!");
            } else {
                this.show(`Customer ${this.customer.name} created successfully`);
                this.$emit('refreshTable');
            }
        })
        .catch(error => {
            this.show(error.message);
        });
    }

    created() {
        this.fetchCustomer(this.$route.params.id);
    }

    @Watch('$route')
    routeChanged (to: Route, from: Route) {
        this.fetchCustomer(to.params.id);
    }
}
</script>