import { createRouter, createWebHashHistory } from 'vue-router'
import ButtonComponent from './components/button-component.vue'

const routes = [
    {
        path: '/home/show-applications',
        component: ButtonComponent
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router
