<template>
    <div id="product">
        <Layout/>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from "@/components/shared/Card.vue";
import Layout from "@/components/product/Layout.vue";

export default Vue.extend({
    components: {
        Layout
    }
})
</script>
