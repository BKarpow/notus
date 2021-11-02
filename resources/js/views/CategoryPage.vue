<template>
    <div class="categoryPage">
        <div class="d-flex">
            <div class="icon-back"></div>
            <div class="title">
                <h2>{{ title }}</h2>
            </div>
        </div>
        <ListItems
            :urlFetch="urlData"
            @meta="(m) => (meta = m)"
            icon="folder"
        />
    </div>
</template>

<script>
import Icons from "./../components/ui/Icons.vue";
import ListItems from "../components/ListItems.vue";
export default {
    name: "CategoryPage",
    components: {
        Icons,
        ListItems,
    },
    computed: {
        title() {
            if (!_.isEmpty(this.meta)) {
                return this.meta.notebook.title;
            }
            return "";
        },
        urlData() {
            return `/category?from=api&notebookId=${this.$route.params.id}`;
        },
    },
    data() {
        return {
            meta: {},
        };
    },
};
</script>
