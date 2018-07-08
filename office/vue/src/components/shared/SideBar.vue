<template>
    <div id="sidebar">
        <router-link class="welcome" to="/about">
            <v-avatar color="red" size="36">
                <span class="white--text headline">P</span>
            </v-avatar>
        </router-link>
        <v-btn color="white" flat to="/"><v-icon color="white">dashboard</v-icon></v-btn>
        <v-btn color="white" flat to="/customer"><v-icon color="white">account_box</v-icon></v-btn>
        <v-btn color="white" flat to="/product"><v-icon color="white">public</v-icon></v-btn>
        <v-btn color="white" flat to="/task"><v-icon color="white">ballot</v-icon></v-btn>
    </div>
</template>

<style lang="scss" scoped>
    #sidebar {
        background-color: #212120;
        width: 50px;
        height: 100vh;
        position: fixed;
        top: 0px;
        z-index: 100;

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
        top: 13px;
        right: -3px;
        content: '';
        width: 0;
        height: 0;
        border-right: solid 8px white;
        border-bottom: solid 8px transparent;
        border-top: solid 8px transparent;
    }
    .welcome {
        height: 56px;
        line-height: 56px;
    }
</style>
