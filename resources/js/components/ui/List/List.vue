<template>
    <ul class="list">
        <Item v-for="item in items" :key="item.id">
            <div class="name">
                <Icons :icon="icon" />
                <router-link
                    :to="{ name: 'Category', params: { id: item.id } }"
                >
                    {{ item.title }}
                </router-link>
            </div>
            <div class="control">
                <span @click="$emit('update', item)" class="pointer">
                    <Icons icon="pen" />
                </span>
                &nbsp;
                <span @click="$emit('delete', item)" class="pointer">
                    <Icons icon="trash" />
                </span>
            </div>
        </Item>
        <Item v-if="isEmptyItems"> Список пуст </Item>
    </ul>
</template>

<script>
import Item from "./Item.vue";
import Icons from "./../Icons.vue";
export default {
    props: {
        items: {
            type: Array,
            required: true,
        },
        icon: {
            type: String,
            default: "add-folder",
        },
    },
    components: {
        Item,
        Icons,
    },
    computed: {
        isEmptyItems() {
            return _.isEmpty(this.items);
        },
    },
};
</script>
