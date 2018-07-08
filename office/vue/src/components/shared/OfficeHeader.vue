<template>
  <div class="header">
    <v-toolbar id="toolbar" color="white darken-4" fixed>
      <v-icon color="black">search</v-icon>
      <v-toolbar-items>
        <input id="searchbar" type="text" placeholder="Search...">
      </v-toolbar-items>
      <v-spacer></v-spacer>
      <v-toolbar-title id="title">
        <router-link to="/about">
          <img id="logo" src="img/logo.png" alt="TRUONGBA">
        </router-link>
      </v-toolbar-title>
    </v-toolbar>
  </div>
</template>

<style scoped lang="scss">
  #toolbar {
    padding-left: 50px !important;
    z-index: 99;
    box-shadow: 0 2px 4px -1px rgba(0,0,0,.2);
  }
  #toolbar * {
    color: white;
  }
  #logo {
    height: 12px;
  }
  #searchbar {
    background-color: transparent;
    color: gray;
    height: 30px;
    padding: 0px 10px;
    border-radius: 5px;
    margin: auto;
    margin-left: 10px;
  }
  #searchbar:focus {
    background-color: #444444;
    color: white;
  }
</style>