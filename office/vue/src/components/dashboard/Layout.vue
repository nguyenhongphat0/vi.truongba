<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs6 md4 lg3 xl2>
                <Stat 
                    cover="<b style='font-size: 80px'>13</b> customers"
                    img="https://lumen.laravel.com/img/bright.jpg"
                    button="View customer"
                    icon="account_box"
                    color="red"/>
            </v-flex>
            <v-flex xs6 md4 lg3 xl2>
                <Stat 
                    cover="<b style='font-size: 80px'>18</b> products"
                    img="https://3.bp.blogspot.com/-0qdhsdCNBcU/VWVtLSFDmpI/AAAAAAAAAvg/DT7dMmlIpwg/s1600/io15material.png"
                    button="View product"
                    icon="public"
                    color="blue"/>
            </v-flex>
            <v-flex xs6 md4 lg3 xl2>
                <Stat 
                    cover="<b style='font-size: 80px'>102</b> tasks"
                    img="https://img.freepik.com/free-vector/elegant-green-geometric-polygon-background_1035-13146.jpg?size=338&ext=jpg"
                    button="View task"
                    icon="account_box"
                    color="green"/>
            </v-flex>
            <v-flex xs6 md4 lg3 xl2>
                <Stat 
                    cover="<b style='font-size: 80px'>12</b> employee"
                    img="https://cdn.guidingtech.com/media/assets/WordPress-Import/2015/01/Material-2.jpg"
                    :nobutton="true"
                    height="152"
                    color="grey"/>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Stat from '@/components/shared/Stat.vue'

@Component({
    components: {
        Stat
    }
})
export default class Layout extends Vue{
    
}
</script>
