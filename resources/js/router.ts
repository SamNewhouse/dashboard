import { createRouter, createWebHistory } from "vue-router";
import DashboardPage from "./components/5-pages/Dashboard.vue";
import ClientsPage from "./components/5-pages/Clients.vue";

const router = createRouter({
  history: createWebHistory("/dashboard"),
  routes: [
    { path: "/", component: DashboardPage, name: "Dashboard" },
    { path: "/clients", component: ClientsPage, name: "Clients" },
    {
      path: "/dashboard/clients/page/:page/show/:perPage",
      name: "ClientsPaginated",
      component: ClientsPage,
      props: true,
    },
  ],
});

export default router;
