<template>
  <layout>
    <div class="container">
      <div class="col-md-6">
        <img
          v-if="product.photo == NULL"
          v-bind:src="'https://omegamma.com.au/wp-content/uploads/2017/04/default-image.jpg'"
          class="img-thumbnail"
        />
        <img v-else :src="product.photo" class="img-thumbnail" />
        <table class="table table-striped">
          <tbody>
            <tr>
              <td>Product Name</td>
              <td>{{ product.name }}</td>
            </tr>
            <tr>
              <td>Product Stock</td>
              <td>{{ product.stock }}</td>
            </tr>
          </tbody>
        </table>
        <button type="button" class="btn btn-warning" v-on:click="editProduct(product.id)">Edit</button> |
        <button type="button" class="btn btn-danger" v-on:click="deleteProduct(product.id)">Delete</button>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "../Layout";

export default {
  props: ["product"],
  components: {
    Layout
  },
  methods: {
    deleteProduct(id) {
      this.$inertia.delete(`/products/${id}`).then(() => {});
    },
    editProduct(id) {
      this.$inertia.visit(`/products/edit/${id}`).then(() => {});
    }
  }
};
</script>
