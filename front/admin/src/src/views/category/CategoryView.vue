<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Categories</h1>

    <div class="d-flex gap-4 flex-row">
      <input class="input-group form-control" type="text" v-model="createdCategoryName" placeholder="Enter category name">
      <button class="btn btn-primary" @click="addCategory">Add</button>
    </div>
    <hr/>

    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search...">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Posts count</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="category in filteredCategories" :key="category.id">
          <td>{{ category.id }}</td>
          <td>{{ category.name }}</td>
          <td>{{ category.post_count }}</td>
          <td>{{ category.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteCategory(category.id)">Delete category</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: 'categoryView',
  data() {
    return {
      categories: [],
      searchQuery: '',
      createdCategoryName: ''
    };
  },
  computed: {
    filteredCategories() {
      return this.categories.filter(categories =>
          categories.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  created() {
    this.fetchCategories();
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('/api/admin/category');
        this.categories = response.data.data.categories;
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async deleteCategory(categoryId){
      try {
        await axios.delete('/api/admin/category/' + categoryId);
        this.categories = this.categories.filter(item => item.id !== categoryId);
        this.$notify('Deleted');
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async addCategory(){
      try{
        const response = await axios.post('/api/admin/category', {
          name: this.createdCategoryName,
        });
        response.data.data[0].post_count = 0;
        this.categories.push(response.data.data[0]);
        this.$notify('Created category');
      }catch(error){
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    }
  }
}
</script>

<style>

</style>
