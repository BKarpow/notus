<template>
    <button @click="onClick" type="button" class="button">
        <slot></slot>
    </button>
</template>

<script>
export default {
    methods: {
        onClick(ev) {
            this.$emit("click", ev);
        },
    },
};
</script>
