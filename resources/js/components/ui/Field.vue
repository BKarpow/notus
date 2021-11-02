<template>
    <form @submit.prevent="onSubmit" class="field-notus">
        <input
            type="text"
            class="field-notus__input"
            :placeholder="placeholder"
            v-model="text"
        />
    </form>
</template>

<script>
export default {
    props: {
        placeholder: {
            type: String,
            default: "",
        },
        value: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            text: this.value,
        };
    },
    methods: {
        onSubmit() {
            this.$emit("submit", this.text);
        },
    },
};
</script>
