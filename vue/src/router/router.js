import SyllabusesList from "../pages/SyllabusesList";
import RPDList from "../pages/RPDList";
import {createRouter, createWebHistory} from "vue-router";

const routes = [
  {
    path: '/',
    component: SyllabusesList
  },
  {
    path: '/list',
    component: RPDList
  }
]

const router = createRouter({
  routes,
  history: createWebHistory()
})

export default router


