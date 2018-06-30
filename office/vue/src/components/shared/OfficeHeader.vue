<template>
  <v-toolbar id="toolbar" color="grey darken-4" fixed>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title id="title">
      <img id="logo" src="img/logo.png" alt="TRUONGBA">
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <input id="searchbar" type="text">
    </v-toolbar-items>
  </v-toolbar>
</template>

<style scoped lang="scss">
    #toolbar * {
      color: white;
    }
    #logo {
      height: 12px;
    }
    #searchbar {
      background-color: #3E2723;
      height: 30px;
      padding: 0px 10px;
      border-radius: 5px;
      margin: auto;
    }
</style>