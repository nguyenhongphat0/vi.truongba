<template>
    <div id="customer">
        <Layout/>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from "@/components/shared/Card.vue";
import Layout from "@/components/customer/Layout.vue";

export default Vue.extend({
    components: {
        Layout
    }
})
</script>
