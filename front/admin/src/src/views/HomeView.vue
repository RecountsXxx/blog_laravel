<template>
  <main class="mt-2 ms-2 d-flex flex-column gap-3">
    <div class="d-flex flex-col gap-5">
    <div class="card" style="width: 18rem;">
      <img src="https://img.icons8.com/ios/150/message-squared.png"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Posts count: {{posts_count}}</h5>
        <p class="card-text">You can see posts and delete post</p>
        <router-link to="/posts" class="btn btn-primary stretched-link">Show posts</router-link>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="https://img.icons8.com/ios-glyphs/240/group.png"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Users count: {{users_count}}</h5>
        <p class="card-text">You can see users and delete users</p>
        <router-link to="/user" class="btn btn-primary stretched-link">Show users</router-link>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="https://img.icons8.com/ios-glyphs/240/categorize.png"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Categories count: {{category_count}}</h5>
        <p class="card-text">You can see categories and add category and delete category</p>
        <router-link to="/category" class="btn btn-primary stretched-link">Show cateogry</router-link>
      </div>
    </div>
      <div class="card" style="width: 18rem;">
        <img src="https://img.icons8.com/ios/250/administrator-male--v1.png"  class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Admins count: {{admins_count}}</h5>
          <p class="card-text">You can see admins and delete admin</p>
          <router-link to="/admin" class="btn btn-primary stretched-link">Show admins</router-link>
        </div>
      </div>
    </div>
    <div class="d-flex flex-col gap-5">
    <div class="card" style="width: 18rem;">
      <img src="https://img.icons8.com/ios/250/post-office.png"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Report posts count: {{report_post_count}}</h5>
        <p class="card-text">You can see reports and delete report and ban user and post</p>
        <router-link to="/report_post" class="btn btn-primary stretched-link">Show report posts</router-link>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="https://img.icons8.com/ios/250/comments--v1.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Report comments count: {{report_comment_count}}</h5>
        <p class="card-text">You can see reports and delete report and ban user and comment</p>
        <router-link to="/report_comment" class="btn btn-primary stretched-link">Show report comments</router-link>
      </div>
    </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: 'homeView',
  data() {
    return {
      posts_count:'1',
      users_count:'1',
      admins_count:'1',
      category_count:'1',
      report_post_count:'1',
      report_comment_count:'1',
    };
  },
  created() {
    this.fetchDashboard();
  },
  methods: {
    async fetchDashboard() {
      try {
        const response = await axios.get('/api/admin/dashboard');
        console.log(response.data.data[0]);
        this.posts_count = response.data.data[0].posts;
        this.users_count = response.data.data[0].users;
        this.admins_count = response.data.data[0].admins;
        this.category_count = response.data.data[0].categories;
        this.report_post_count = response.data.data[0].reports_posts;
        this.report_comment_count = response.data.data[0].reports_comments;
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
  },
}
</script>

<style scoped>

</style>
