<template>
  <div id="app">
    <div id="loged" v-if="$route.name != 'login'">
      <OfficeHeader></OfficeHeader>
      <SideBar></SideBar>
      <div id="content">
        <router-view/>
      </div>
    </div>
    <div id="login" v-if="$route.name == 'login'">
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
* {
  font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
  // font-family: Muli,Helvetica,Arial,sans-serif;
}
#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  padding-top: 56px;
}
#content {
  padding-left: 50px;
  margin: 10px;
}
.card__title {
  text-align: left;
}
.contain .card__media__background {
  background-size: contain !important;
}
input[type="text"].flat, input[type="password"].flat, textarea.flat {
  border: none;
  width: 100%;
  transition-duration: 0.5s;
  cursor: pointer;
}
input[type="text"].flat:hover, input[type="text"].flat:focus, input[type="password"].flat:hover, input[type="password"].flat:focus, textarea.flat:hover, textarea.flat:focus {
  padding: 0px 5px;
  border: 1px dashed #2c3e50;
  border-radius: 3px;
  background-color: white;
}
</style>
