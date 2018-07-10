<template>
  <v-layout>
    <v-flex xs12>
      <v-card class="card">
        <v-card-media :src="img" :height="height" :class="backgroundsize">
          <div style="margin: auto; color: white">
            <h1 v-html="cover" :style="'text-align: ' + align"></h1>
          </div>
        </v-card-media>
        <v-card-title primary-title v-if="!nocontent">
          <div style="width: 100%">
            <h2 class="headline mb-0" :style="'text-align: ' + align">{{title}}</h2>
            <div :style="'text-align: ' + align"><slot></slot></div>
          </div>
        </v-card-title>
        <v-card-actions v-if="button">
          <v-btn flat :color="color"><v-icon>{{icon}}</v-icon> {{button}}</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component";

@Component({
  props: [
    'title', 'img', 'button', 'icon', 'color', 'cover', 'height', 'nocontent', 'align', 'backgroundsize'
  ]
})
export default class Card extends Vue {
}
</script>

<style>
  .card {
    border-radius: 8px !important;
    margin: 5px;
  }
</style>
