<template>
    <div id="sidebar">
        <v-btn flat to="/"><v-icon color="white">dashboard</v-icon></v-btn>
        <v-btn flat to="/customer"><v-icon color="white">account_box</v-icon></v-btn>
        <v-btn flat to="/product"><v-icon color="white">public</v-icon></v-btn>
        <v-btn flat to="/task"><v-icon color="white">ballot</v-icon></v-btn>
        <v-btn flat to="/about"><v-icon color="white">info</v-icon></v-btn>
    </div>
</template>

<style lang="scss" scoped>
    #sidebar {
        background-color: #E53935;
        width: 50px;
        height: 100vh;
        position: fixed;

        > a {
            width: 100%;
            min-width: 100%;
            margin: 0px;
        }
        i {
            display: block;
            padding: 10px;
            cursor: pointer;
            position: relative;
        }
        a {
            text-decoration: none;
            outline: 0;
        }
    }
    .btn--active i::after {
        position: absolute;
        top: 15px;
        right: -3px;
        content: '';
        width: 0;
        height: 0;
        border-right: solid 5px white;
        border-bottom: solid 5px transparent;
        border-top: solid 5px transparent;
    }
</style>
