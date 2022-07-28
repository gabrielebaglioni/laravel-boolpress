import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import About from "./pages/About"; 
import SinglePost from "./pages/SinglePost";
import Categories from "./pages/Categories";
import SingleCategory from "./pages/SingleCategory";
import Page404 from "./pages/Page404";


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
         path: "/chi-siamo",
         name: "about",
         component: About,
        },
        {
         path: "/posts/:slug",
         name: "single-post",
         component: SinglePost,
        },
        {
         path: "/category",
         name: "categories",
         component: Categories,
        },
        {
         path: "/category/:slug",
         name: "single-category",
         component: SingleCategory,
        },
        
        {
         path: "/*",
         name: "page-404",
         component: Page404,
        },
    ] 
});

export default router