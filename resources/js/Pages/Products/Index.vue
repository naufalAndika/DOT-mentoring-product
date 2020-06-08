<template>
  <layout>
    <div class="container">
      <div v-if="successMessage" class="alert alert-success mt-4">
        {{ successMessage }}
      </div>

      <div class="my-5">
        <a href="/products/create" class="btn btn-primary">Add New Product</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td><inertia-link :href="'/products/detail/' + product.id">{{ product.name }}</inertia-link></td>
            <td>{{ product.stock }}</td>
            <td>
              <button type="button" class="btn btn-warning" v-on:click="editProduct(product.id)">Edit</button> | 
              <button type="button" class="btn btn-danger" v-on:click="deleteProduct(product.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </layout>
</template>

<script>
import Layout from '../Layout'

  export default {
    props: ['products', 'successMessage'],
    components: {
      Layout,
    },
    methods: {
      deleteProduct(id) {
        this.$inertia.delete(`/products/${id}`).then(() => {

        });
      },
      editProduct(id) {
        this.$inertia.visit(`/products/edit/${id}`).then(() => {

        });
      }
    }
  }
</script>
