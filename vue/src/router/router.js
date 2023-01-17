import SyllabusesList from "../pages/SyllabusesList";
import RPDList from "../pages/RPDList";
import RPD from "../pages/RPD";
import Statistics from "../pages/Statistics";
import KafsList from "@/pages/KafsList";
import {createRouter, createWebHistory} from "vue-router";

const routes = [
  {
    path: '/',
    component: SyllabusesList,
    alias: '/plans'
  },
  {
    path: '/kafs',
    component: KafsList,
  },
  {
    path: '/list',
    component: RPDList
  },
  {
    path: '/rpd',
    component: RPD
  },
  {
    path: '/stat',
    component: Statistics
  }
]

const base = process.env.VUE_APP_BASE_ROUTER_URL
const router = createRouter({
  routes,
  history: createWebHistory(base),

})

export default router


