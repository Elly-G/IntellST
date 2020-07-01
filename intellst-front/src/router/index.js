import Vue from "vue";
import Router from "vue-router";
import NotFound from "@/views/NotFound";

Vue.use(Router);

const router = new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      component: () => import("../views/Dashboard.vue"),
      children: [
        {
          path: "",
          name: "",
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "/",
              name: "Home",
              component: () => import("../views/HomePage.vue"),
            },
            {
              path: "/cases",
              name: "Cases",
              component: () => import("../views/ConsultCases.vue"),
            },
            {
              path: "/settings",
              name: "Settings",
              component: () => import("../views/Settings.vue"),
            },
            {
              path: "/FAQ",
              name: "FAQ",
              component: () => import("../views/FAQ.vue"),
            },
            {
              path: "/notifications",
              name: "NotificationPage",
              component: () => import("../views/NotificationPage.vue"),
            },
          ],
        },
      ],
    },
    {
      path: "/login",
      name: "Login",
      component: () => import("../views/Login.vue"),
    },
    {
      path: "*",
      name: "notfound",
      component: NotFound,
    },
  ],
});

export default router;
