<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Posts</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search...">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Text</th>
          <th>Author id</th>
          <th>Category id</th>
          <th>Likes</th>
          <th>Views</th>
          <th>Created at</th>
          <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="post in filteredPosts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td :title="post.text">{{ limitText(post.text) }}</td>
          <td>{{ post.author_id }}</td>
          <td>{{ post.category_id }}</td>
          <td>{{ post.likes_count }}</td>
          <td>{{ post.views_count }}</td>
          <td>{{ post.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deletePost(post.id)">Delete post</button>
            <button class="btn btn-primary"><a class="text-decoration-none text-white" :href="'http://localhost/post/' + post.id">View post</a></button>
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
  name: 'postView',
  data() {
    return {
      posts: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredPosts() {
      return this.posts.filter(post =>
          post.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    async fetchPosts() {
      try {
        const response = await axios.get('/api/admin/post');
        this.posts = response.data.data[0];
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
    limitText(text) {
      return text.length > 70 ? text.substring(0, 50) + '...' : text;
    },
    async deletePost(postId){
      try {
        await axios.delete('/api/admin/post/' + postId);
        this.posts = this.posts.filter(item => item.id !== postId);
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
