<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Users</h1>
    <div class="d-flex gap-4 flex-row">
      <input class="input-group form-control" type="text" v-model="user.name" placeholder="Enter name">
      <input class="input-group form-control" type="email" v-model="user.email" placeholder="Enter email">
      <input class="input-group form-control" type="password" v-model="user.password" placeholder="Enter password">
      <button class="btn btn-primary" @click="addUser">Add</button>
    </div>
    <hr/>
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Avatar</th>
          <th>Email</th>
          <th>Banned posts</th>
          <th>Banned comments</th>
          <th>Created at</th>
          <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in filteredUsers" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td><img :src="user.avatar_url" width="30px" height="30px"  alt=""/></td>
          <td>{{ user.email }}</td>
          <td>{{ user.is_banned_posts }}</td>
          <td>{{ user.is_banned_comments }}</td>
          <td>{{ user.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteUser(user.id)">Delete user</button>
            <button class="btn btn-danger" @click="banPosts(user.id)">Ban posts</button>
            <button class="btn btn-danger" @click="banComments(user.id)">Ban comments</button>
            <button class="btn btn-primary" @click="unban(user.id)">Unban user</button>
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
  name: 'userView',
  data() {
    return {
      users: [],
      searchQuery: '',
      user: {
        name: '',
        email: '',
        password: ''
      }
    };
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user =>
          user.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    async addUser(){
      try{
        const response = await axios.post('/api/auth/register',{
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
          password_confirmation: this.user.password
        });
        console.log(response.data.data.user);
        this.$notify('Added user');
        this.users.push(response.data.data.user);

      }catch (error) {
        console.error('Error:', error.response);
      }
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/api/admin/user');
        this.users = response.data.data[0];
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async deleteUser(userId){
      try {
        await axios.delete('/api/admin/user/' + userId);
        this.users = this.users.filter(item => item.id !== userId);
        this.$notify('Deleted');
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async banPosts(userId){
      try {
        await axios.post('/api/admin/user/ban_posts/' + userId);
        this.users = this.users.map(user => {
          if (user.id === userId) {
            user.is_banned_posts = 1;
          }
          return user;
        });
        this.$notify('Banned');
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async banComments(userId){
      try {
        await axios.post('/api/admin/user/ban_comments/' + userId);
        this.users = this.users.map(user => {
          if (user.id === userId) {
            user.is_banned_comments = 1;
          }
          return user;
        });
        this.$notify('Banned');
      } catch (error) {
        console.error('Error:', error.response);
        this.$notify("Error: " + JSON.parse(error.response.request.response).message);
      }
    },
    async unban(userId){
      try {
        await axios.post('/api/admin/user/unban/' + userId);
        this.users = this.users.map(user => {
          if (user.id === userId) {
            user.is_banned_comments = 0;
            user.is_banned_posts = 0;
          }
          return user;
        });
        this.$notify('Unbanned');
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
