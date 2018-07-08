<template>
  <v-layout>
    <v-flex xs12>
      <v-card class="card">
        <v-card-media :src="img" :height="height">
          <div style="margin: auto; color: white">
            <h1 v-html="cover"></h1>
          </div>
        </v-card-media>
        <v-card-title primary-title v-if="!nocontent">
          <div>
            <h3 class="headline mb-0">{{title}}</h3>
            <div>{{content}}</div>
          </div>
        </v-card-title>
        <v-card-actions v-if="!nobutton">
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
    'title', 'content', 'img', 'button', 'icon', 'color', 'cover', 'height', 'nocontent', 'nobutton'
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
