<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Admins</h1>

    <div class="d-flex gap-4 flex-row">
      <input class="input-group form-control" type="text" v-model="admin.name" placeholder="Enter name">
      <input class="input-group form-control" type="email" v-model="admin.email" placeholder="Enter email">
      <input class="input-group form-control" type="password" v-model="admin.password" placeholder="Enter password">
      <button class="btn btn-primary" @click="addAdmin">Add</button>
    </div>
    <hr/>

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
      searchQuery: '',
      admin: {
        name: '',
        email: '',
        password: ''
      }
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
    async addAdmin(){
      try{
        const response = await axios.post('/api/admin/auth/register',{
          name: this.admin.name,
          email: this.admin.email,
          password: this.admin.password
        });
        this.$notify('Added admin');
        this.admins.push(response.data.data.user);

      }catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async fetchAdmins() {
      try {
        const response = await axios.get('/api/admin/admin');
        this.admins = response.data.data[0];
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async deleteAdmin(adminId){
      try {
        await axios.delete('/api/admin/admin/' + adminId);
        this.admins = this.admins.filter(item => item.id !== adminId);
        this.$notify('Deleted');
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    }
  }
}
</script>

<style>

</style>
