<template>
  <div>
    <div v-if="!customers">
      <v-progress-circular
        :size="70"
        :width="7"
        color="red"
        indeterminate
      ></v-progress-circular>
    </div>
    <v-data-table
      v-if="customers"
      :headers="headers"
      :items="customers"
      item-key="id"
      id="table"
      :rows-per-page-items='[5]'
      :loading="loading"
    >
      <v-progress-linear slot="progress" color="red" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <tr @click="select(props.item)" :class="{'red--text': $route.params.id == props.item.id }">
          <td class="text-xs-left">{{ props.item.name }}</td>
          <td class="truncated">{{ props.item.organization }}</td>
          <td>{{ props.item.phone }}</td>
          <td class="truncated">{{ props.item.address }}</td>
        </tr>
      </template>
    </v-data-table>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import Customer, {  CustomerHeader } from '../../models/customer';
import { Prop, Emit } from 'vue-property-decorator';

@Component({})
export default class CustomerTable extends Vue {
    headers = CustomerHeader;
    customers: Customer[] | null = null;
    selected: Customer | null = null;
    loading: boolean = false;

    select(customer: Customer) {
      if (this.selected == customer) {
        this.selected = null;
        this.$router.push(`/customer`);
      } else {
        this.selected = customer;
        this.$router.push(`/customer/${customer.id}`);
      }
      this.loading = true;
      setTimeout(a => {
        this.loading = false
      }, 500);
    }

    constructor() {
      super();
      this.fetchCustomer();
    }

    fetchCustomer() {
      this.loading = true;
      fetch(`/api/customer`)
        .then(res => res.json() as Promise<Customer[]>)
        .then(customers => {
          this.customers = customers;
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
