<template>
    <div class="cr-notebook">
        <Button @click="showForm = !showForm">
            <Icons :icon="toggleIcon" /> {{ toggleBtnText }}
        </Button>
        <div class="mt-1">
            <Field @submit="onStore" v-if="showForm" :placeholder="btnText" />
        </div>
    </div>
</template>

<script>
import Field from "./ui/Field.vue";
import Button from "./ui/Button.vue";
import Icons from "./ui/Icons.vue";
export default {
    props: {
        btnText: {
            type: String,
            default: "Создать",
        },
        btnTextClose: {
            type: String,
            default: "Отмена",
        },
        iconBtn: {
            type: String,
            default: "add-folder",
        },
    },

    components: {
        Field,
        Button,
        Icons,
    },
    computed: {
        toggleBtnText() {
            if (this.showForm) {
                return this.btnTextClose;
            }
            return this.btnText;
        },
        toggleIcon() {
            if (this.showForm) {
                return "close";
            }
            return this.iconBtn;
        },
    },
    data() {
        return {
            showForm: false,
        };
    },
    methods: {
        onStore(val) {
            this.$emit("store", val);
            this.showForm = false;
        },
    },
};
</script>
