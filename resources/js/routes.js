import IndexPage from "./views/IndexPage.vue";
import CategoryPage from "./views/CategoryPage.vue";

const routes = [
    {
        path: "/home",
        name: "Index",
        component: IndexPage,
    },
    {
        path: "/home/:id",
        name: "Category",
        component: CategoryPage,
    },
];

export default routes;
