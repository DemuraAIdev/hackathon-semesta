import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import UserDSView from "@/views/dashboard/UserDSView.vue";
import { useAuthStore } from "@/stores/auth";
import ReportView from "@/views/dashboard/report/ReportView.vue";
import ReportCreateView from "@/views/dashboard/report/ReportCreateView.vue";
import AssignmentView from "@/views/dashboard/assignment/AssignmentView.vue";
import ReportDetailView from "@/views/dashboard/report/ReportDetailView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/login",
      name: "Login",
      component: () => import("../views/auth/LoginView.vue"),
    },
    {
      path: "/dashboard",
      name: "UserDashboard",
      component: UserDSView,
      meta: { requireAuth: true },
    },
    {
      path: "/report",
      name: "ReportUser",
      component: ReportView,
      meta: { requireAuth: true },
    },

    {
      path: "/report/create",
      name: "ReportCreateUser",
      component: ReportCreateView,
      meta: { requireAuth: true },
    },
    {
      path: "/report/:id",
      name: "ReportDetailVue",
      component: ReportDetailView,
      meta: { requireAuth: true },
    },
    {
      path: "/assignment",
      name: "Assignment",
      component: AssignmentView,
      meta: { requireAuth: true },
    },
  ],
});

// Guard Route Logic
router.beforeEach(async (to, from, next) => {
  const user = useAuthStore();
  if (to.meta.requireAuth) {
    if (!user.isAuthenticated) {
      console.log("illegal action detected");
      return next({ name: "Login" });
    }

    if (!user.user) {
      const res = await user.fetchUser();
      if (res) {
        return next();
      }
      user.logout();
      next({ name: "login" });
    }
    next();
  } else {
    next();
  }
});

export default router;
