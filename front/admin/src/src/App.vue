<template>
  <div class="container-fluid">
    <div class="row">
      <notifications width="300" size="4" />
        <div v-if="isAuthenticated" class="col-sm-2 vh-100 bg-dark">
          <NavComponent></NavComponent>
        </div>
        <div v-else class="container-fluid w-full w-100">
          <LoginView></LoginView>
        </div>


      <div v-if="isAuthenticated" class="col-sm-10">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import NavComponent from "@/components/NavComponent.vue";
import LoginView from "@/views/auth/LoginView.vue";
import { userStore } from "@/stores/store.js";
import {Notifications} from "@kyvg/vue3-notification";

export default {
  components: {
    Notifications,
    LoginView,
    NavComponent
  },
  data() {
    return {
      isAuthenticated: false
    };
  },
  created() {
    this.updateAuthentication();
    const userState = userStore();
    userState.$subscribe((store) => {
      this.updateAuthentication();
    });
  },
  methods: {
    updateAuthentication() {
      const userState = userStore();
      this.isAuthenticated = !!userState.user;
    }
  }
};
</script>




