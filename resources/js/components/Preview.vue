<template>
    <div class="image-container alert-dismissible" v-if="showPreview">
        <div v-if="showPreview && images.length > 0">
            <h5 class="text-center">Campaign images</h5>
            <button
                @click="dismissPopUp"
                type="button"
                class="btn-close"
                aria-label="Close"
            >
                <span aria-hidden="true"></span>
            </button>
            <div>
                <img
                    v-for="(img, index) in images"
                    v-bind:key="index"
                    :src="`/${img.file_url}`"
                    alt=""
                />
            </div>
        </div>
        <div v-if="showPreview && images.length === 0">
            <h6 class="text-center">No images here...</h6>
             <button
                @click="dismissPopUp"
                type="button"
                class="btn-close"
                aria-label="Close"
            >
                <span aria-hidden="true"></span>
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            campaign_id: "",
            images: [],
            showPreview: false,
        };
    },

    methods: {
        async fetchImages() {
            const response = await axios.get(
                `/api/v1/get-images/${this.campaign_id}`
            );
            if (response.data.status === "success") {
                this.showPreview = true;
                this.images = response.data.data;
            }
        },
        dismissPopUp() {
            this.images = [];
            this.showPreview = false;
        },
    },

    mounted() {
        Event.$on("show_preview", async (data) => {
            this.campaign_id = data;
            await this.fetchImages();
        });
    },
};
</script>

<style scoped>
.image-container {
    position: absolute;
    z-index: 10;
    background: #ffffff;
    top: 50px;
    right: 100px;
    left: 100px;
    text-align: center;
    border: 2px solid #d2d2d2;
    padding: 50px;
}
.image-container > div > div {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.image-container img {
    margin: 10px;
    width: 100px;
    height: 100px;
}
</style>
