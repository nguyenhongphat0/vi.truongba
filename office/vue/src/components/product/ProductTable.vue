<template>
  <div>
    <v-layout row wrap>
        <v-btn v-if="admin" class="red white--text" to="/product/new">Add new product</v-btn>
    </v-layout>
    <div v-if="!products">
      <v-progress-circular
        :size="70"
        :width="7"
        color="red"
        indeterminate
      ></v-progress-circular>
    </div>
    <v-data-table
      v-if="products"
      :headers="headers"
      :items="products"
      item-key="id"
      id="table"
      :rows-per-page-items='[5]'
      :loading="loading"
    >
      <v-progress-linear slot="progress" color="red" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <tr @click="select(props.item)" :class="{'red--text': $route.params.id == props.item.id }">
          <td class="text-xs-left">{{ props.item.name }}</td>
          <td class="truncated">{{ props.item.description }}</td>
          <td>{{ props.item.status }}</td>
          <td class="truncated">{{ props.item.date_created }}</td>
        </tr>
      </template>
    </v-data-table>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Product, {  ProductHeader } from '../../models/product';
import { Prop, Emit } from 'vue-property-decorator';

@Component({})
export default class ProductTable extends Vue {
    headers = ProductHeader;
    products: Product[] | null = null;
    selected: Product | null = null;
    loading: boolean = false;
    admin: boolean = false;

    select(product: Product) {
      if (this.selected == product) {
        this.selected = null;
        this.$router.push(`/product`);
      } else {
        this.selected = product;
        this.$router.push(`/product/${product.id}`);
      }
      this.loading = true;
      setTimeout(a => {
        this.loading = false
      }, 500);
    }

    constructor() {
      super();
      this.admin = localStorage.getItem('admin') == '1';
      this.fetchProduct();
    }

    fetchProduct() {
      this.loading = true;
      fetch(`/api/product`)
        .then(res => res.json() as Promise<Product[]>)
        .then(products => {
          this.products = products;
          this.loading = false;
      })
    }
}
</script>

<style>
  #table {
    box-shadow: none !important;
    cursor: pointer;
    width: 100%;
  }
  th {
    font-weight: bold !important;
  }
  td.truncated {
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
