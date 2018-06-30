<template>
    <Product/>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Product from '@/components/dashboard/Product.vue'

@Component({
    components: {
        Product
    }
})
export default class Layout extends Vue{}   
</script>
