<template>
    <v-layout>
        <v-flex xs6 offset-xs3>
            <Card title="Login" style="width: unset" align="center" :img="avatar" height="100" backgroundsize="contain">
                <div>
                    Login to the system on {{new Date().toLocaleString()}}
                    <input @keyup.enter="login" v-model="username" type="text" class="flat" placeholder="Username" style="text-align: center">
                    <input @keyup.enter="login" v-model="password" type="password" class="flat" placeholder="Password" style="text-align: center">
                </div>
                <div>
                    <v-btn @click="login" class="red white--text" v-if="!loading">Login</v-btn>
                    <v-btn flat @click="login" class="red--text" disabled v-if="loading">Loging in...</v-btn>
                </div>
            </Card>
            <img src="/img/logo.png" alt="TRUONGBA" style="margin-top: 100px">
            <v-snackbar v-model="snacking" :timeout=0>
                {{message}} <v-btn color="red" flat @click="snacking = false">Close</v-btn>
            </v-snackbar>
        </v-flex>
    </v-layout>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Card from '@/components/shared/Card.vue'

@Component({
    components: {
        Card
    },
    computed: {
        avatar() {
            return this.username ? '/img/avatar/' + this.username : '/img/truongba.jpg';
        }
    }
})
export default class Login extends Vue{
    message: string = 'Enter your username and password to continue';
    username: string = '';
    password: string = '';
    snacking: boolean = true;
    loading: boolean = false;

    async login() {
        this.loading = true;
        let res = await fetch(`/api/user/login.php?username=${this.username}&password=${this.password}`, {
            credentials: 'include'
        }).then(res => res.json() as Promise<boolean>);
        if (res == true) {
            this.message = 'Welcome ' + this.username;
            this.snacking = true;
            this.$router.push('/')
        } else {
            this.message = 'Incorrect username or password';
            this.snacking = true;
        }
        this.loading = false;
    }
}
</script>
