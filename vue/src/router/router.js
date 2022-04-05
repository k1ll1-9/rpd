import SyllabusesList from "../pages/SyllabusesList";
import RPDList from "../pages/RPDList";
import RPD from "../pages/RPD";
import {createRouter, createWebHistory} from "vue-router";

const routes = [
  {
    path: '/',
    component: SyllabusesList
  },
  {
    path: '/list',
    component: RPDList
  },
  {
    path: '/rpd',
    component: RPD
  }
]
const base = (process.env.NODE_ENV === 'development') ? '' : '/vavt-web/syllabuses-test/'
const router = createRouter({
  routes,
  history: createWebHistory(base)
})

export default router


