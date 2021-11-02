<template>
    <div class="" v-if="showUpdateForm">
        <div class="d-flex justify-content-end my-1">
            <Button @click="showUpdateForm = false">
                <Icons icon="close" /> Закрыть
            </Button>
        </div>
        <Field :value="item.title" @submit="onUpdate" placeholder="Новое имя" />
    </div>
</template>

<script>
import Button from "./ui/Button.vue";
import Field from "./ui/Field.vue";
import Icons from "./ui/Icons.vue";
export default {
    components: {
        Button,
        Field,
        Icons,
    },
    data() {
        return {
            showUpdateForm: false,
            item: {},
            val: "",
        };
    },
    methods: {
        init(item) {
            this.item = item;
            this.showUpdateForm = true;
        },
        onUpdate(text) {
            this.$emit("update", {
                id: this.item.id,
                title: text,
            });
            this.showUpdateForm = false;
        },
    },
};
</script>
