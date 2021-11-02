<template>
    <div>
        <div class="d-flex justify-content-between mt-1">
            <CreateGroup @store="onStore" />
        </div>
        <UpdateForm @update="onUpdate" ref="update" />
        <div class="mt-1">
            <List
                @update="updateModeEnable"
                @delete="deleteItem"
                :items="items"
                :icon="icon"
            />
        </div>
    </div>
</template>

<script>
import List from "./ui/List/List.vue";
import CreateGroup from "./CreateGroup.vue";
import UpdateForm from "./UpdateForm.vue";
export default {
    props: {
        icon: {
            type: String,
        },
        urlFetch: {
            type: String,
            required: true,
        },
    },
    components: {
        List,
        CreateGroup,
        UpdateForm,
    },
    data() {
        return {
            items: [],
            showSpin: false,
        };
    },
    methods: {
        updateModeEnable(item) {
            this.$refs.update.init(item);
        },
        onUpdate(data) {
            axios.put(this.urlFetch, data).then((r) => {
                if (r.status === 200) {
                    this.updateItemFromList(data);
                }
            });
        },
        onStore(val) {
            axios.post(this.urlFetch, { title: val }).then((r) => {
                if (!_.isEmpty(r.data.data)) {
                    this.addNewItemToList(r.data.data);
                } else {
                    console.error("Error create item", r);
                }
            });
        },
        deleteItem(item) {
            if (!confirm(`Удалить это: ${item.title}`)) return false;
            axios
                .delete(`${this.urlFetch}&id=${item.id}`)
                .then((r) => {
                    if (r.status === 200) {
                        if (r.data.deletedId == item.id) {
                            this.removeItemFromList(item);
                        }
                    }
                })
                .catch((er) => {
                    console.error("Deleted error", er);
                });
        },
        updateItemFromList(data) {
            this.items = this.items.map((i) => {
                if (i.id === data.id) {
                    i.title = data.title;
                }
                return i;
            });
        },
        removeItemFromList(item) {
            this.items = this.items.filter((i) => {
                if (item.id === i.id) return false;
                return true;
            });
        },
        addNewItemToList(item) {
            if (Array.isArray(this.items)) {
                this.items.unshift(item);
            }
        },
        fetchItems() {
            this.showSpin = true;
            axios
                .get(this.urlFetch)
                .then((r) => {
                    if (r.data.hasOwnProperty("meta")) {
                        this.$emit("meta", r.data.meta);
                    }
                    if (r.status === 200 && !_.isEmpty(r.data.data)) {
                        this.items = r.data.data;
                        this.showSpin = false;
                    }
                })
                .catch((err) => {
                    console.error("Error", err);
                });
        },
    },
    mounted() {
        this.fetchItems();
    },
};
</script>
