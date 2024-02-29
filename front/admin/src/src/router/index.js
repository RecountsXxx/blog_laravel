import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import PostView from "@/views/post/PostView.vue";
import CategoryView from "@/views/category/CategoryView.vue";
import UserView from "@/views/user/UserView.vue";
import ReportPostsView from "@/views/report/ReportPostsView.vue";
import ReportCommentsView from "@/views/report/ReportCommentsView.vue";
import AdminView from "@/views/admin/AdminView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/dashboard', component: HomeView},
    {path: '/posts', component: PostView},
    {path: '/category', component: CategoryView},
    {path: '/user', component: UserView},
    {path: '/admin', component: AdminView},
    {path: '/report_post', component: ReportPostsView},
    {path: '/report_comment', component: ReportCommentsView},
  ]
})

export default router
