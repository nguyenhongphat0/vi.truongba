<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-btn class="red white--text" to="/customer/new">Add new customer</v-btn>
        </v-layout>
        <v-layout row wrap>
            <v-flex xs12 md6 v-if="detailed">
                <CustomerDetail @refreshTable="$refs.table.fetchCustomer()" />
            </v-flex>
            <v-flex xs12 :md6="detailed">
                <CustomerTable ref="table" />
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import CustomerTable from './CustomerTable.vue'
import Customer from '@/models/customer'
import CustomerDetail from './CustomerDetail.vue'

export default {
    components: {
        CustomerTable,
        CustomerDetail
    },
    computed: {
        detailed() {
            return this.$route.params.id != null;
        }
    }
}
</script>
