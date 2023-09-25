import { createRouter, createWebHistory } from "vue-router";
const routes = [
    // { path: "/foo", component: Foo },
    // { path: "/bar", component: Bar },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
