<template>
  <layout>
    <div class="container">
      <div class="col-md-6">
        <form action="/products" method="POST" class="my-5" @submit.prevent="updateProduct">
          <div class="form-group">
            <label for="name">Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Name"
              v-model="form.name"
            />
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input
              type="text"
              class="form-control"
              id="stock"
              placeholder="Stock"
              v-model="form.stock"
            />
          </div>
          <div class="form-group">
            <label for="photo">Product Image</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="photo">Upload</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="photo" v-on:change="handleFile" />
                <label class="custom-file-label" for="photo">Choose file</label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Edit Product</button>
        </form>
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
  data() {
    return {
      form: {
        name: this.product.name,
        stock: this.product.stock,
        file: ""
      }
    };
  },
  methods: {
    updateProduct() {
      var data = new FormData();
      data.append("name", this.form.name);
      data.append("stock", this.form.stock);
      data.append("photo", this.file);

      console.log(data);

      this.$inertia.post(`/products/${this.product.id}`, data).then(() => {
          // code
        });
    },
    handleFile(e) {
      this.file = e.target.files[0];
    }
  }
};
</script>
