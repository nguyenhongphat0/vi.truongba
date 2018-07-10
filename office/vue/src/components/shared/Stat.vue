<template>
  <Card
    :img="img"
    :button="button"
    :icon="icon"
    :color="color"
    :cover="cover"
    :height="height"
    :nocontent="true"
  />
</template>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component";
import { Prop } from 'vue-property-decorator';
import Card from "./Card.vue";

@Component({
  props: [
    'img', 'button', 'icon', 'color', 'cover', 'height', 'nocontent', 'nobutton'
  ],
  components: {
    Card
  }
})
export default class Stat extends Vue {
}
</script>
