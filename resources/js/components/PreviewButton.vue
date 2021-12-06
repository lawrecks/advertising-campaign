<template>
    <div>
        <button @click="createEvent" class="btn btn-primary">
            View
        </button>
    </div>
</template>

<script>
export default {
    props: ["campaign_id"],
    methods: {
        createEvent() {
            var data = this.campaign_id;
            console.log("clicked!");
            Event.$emit("show_preview", data);
        },
    },
};
</script>
