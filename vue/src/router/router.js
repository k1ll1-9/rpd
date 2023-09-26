import SyllabusesList from "../pages/SyllabusesList";
import RPDList from "../pages/RPDList";
import RPD from "../pages/RPD";
import Statistics from "../pages/Statistics";
import KafsList from "@/pages/KafsList";
import {createRouter, createWebHistory} from "vue-router";
import RPDListPub from "../components/Public/RPDListPub.vue";

let list

if (process.env.VUE_APP_NODE_ENV === 'public') {
    list = {
        path: '/list-pub',
        component: RPDListPub
    }
} else {
    list = {
        path: '/list',
        component: RPDList
    }
}

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
        path: '/rpd',
        component: RPD
    },
    {
        path: '/stat',
        component: Statistics
    },
    {
        path: '/list-pub',
        component: RPDListPub
    },
    list
]

const base = process.env.VUE_APP_BASE_ROUTER_URL
const router = createRouter({
    routes,
    history: createWebHistory(base),

})

export default router


