<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Admins</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search...">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Created at</th>
          <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="admin in filteredAdmins" :key="admin.id">
          <td>{{ admin.id }}</td>
          <td>{{ admin.name }}</td>
          <td>{{ admin.email }}</td>
          <td>{{ admin.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteAdmin(admin.id)">Delete admin</button>
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
  name: 'adminView',
  data() {
    return {
      admins: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredAdmins() {
      return this.admins.filter(admin =>
          admin.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  created() {
    this.fetchAdmins();
  },
  methods: {
    async fetchAdmins() {
      try {
        const response = await axios.get('/api/admin/admin');
        console.log(response.data.data[0]);
        this.admins = response.data.data[0];
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
    async deleteAdmin(adminId){
      try {
        await axios.delete('/api/admin/admin/' + adminId);
        this.admins = this.admins.filter(item => item.id !== adminId);
        this.$notify('Deleted');
      } catch (error) {
        console.error('Error:', error.response);
      }
    }
  }
}
</script>

<style>

</style>
