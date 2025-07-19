import { defineStore } from "pinia";
import api from "@/api";

export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      token: localStorage.getItem("auth_token") || null,
      user: null,
      role: [] as string[],
    };
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  actions: {
    async fetchUser() {
      if (!this.token) {
        console.log("token not found");
        this.logout();
        return null;
      }

      const res = await api.get("/me");
      if (!res.data.data) {
        console.log(res.data.data);
        console.log("token has been rejected");
        this.logout();
        return null;
      }
      console.log(res.data);
      this.user = res.data.data;
      this.role = res.data.role;
      console.log("user signed by server");

      return res.data.data;
    },
    logout() {
      localStorage.removeItem("auth_token");
      this.token = null;
      this.user = null;
    },
  },
});
