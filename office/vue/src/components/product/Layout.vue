<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 md6 v-if="detailed">
                <ProductDetail @refreshTable="$refs.table.fetchProduct()" />
            </v-flex>
            <v-flex xs12 :md6="detailed">
                <ProductTable ref="table" />
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import ProductTable from './ProductTable.vue'
import Product from '@/models/customer'
import ProductDetail from './ProductDetail.vue'

export default {
    components: {
        ProductTable,
        ProductDetail
    },
    computed: {
        detailed() {
            return this.$route.params.id != null;
        }
    }
}
</script>
