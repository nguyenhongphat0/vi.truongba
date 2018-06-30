<template>
  <div id="app">
    <OfficeHeader></OfficeHeader>
    <SideBar></SideBar>
    <div id="content">
      <router-view/>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import OfficeHeader from '@/components/shared/OfficeHeader.vue';
import SideBar from '@/components/shared/SideBar.vue';

@Component({
  components: {
    OfficeHeader,
    SideBar
  }
})
export default class App extends Vue {}
</script>


<style lang="scss">
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  padding-top: 56px;
}
#content {
  padding-left: 50px;
}
</style>
