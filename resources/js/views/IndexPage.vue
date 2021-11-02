<template>
    <div class="indexPage">
        <Field placeholder="Поиск заметок..." />
        <ListItems urlFetch="/notebook/?from=api" icon="folder" />
    </div>
</template>

<script>
import Field from "../components/ui/Field.vue";

import ListItems from "../components/ListItems.vue";
export default {
    name: "IndexPage",
    components: {
        Field,
        ListItems,
    },
};
</script>
