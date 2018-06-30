<template>
  <div class="home">
    <Layout/>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import Layout from '@/components/dashboard/Layout.vue'; // @ is an alias to /src

@Component({
  components: {
    Layout
  },
})
export default class Home extends Vue {}
</script>
