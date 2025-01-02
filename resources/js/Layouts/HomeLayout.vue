<script>

import Snowflakes from "@/Components/Snowflakes.vue";

export default {
    name: "HomeLayout",
    components: {Snowflakes},
    data() {
        return {
            showSnowflakes: false,
        }
    },
    mounted() {
        const currentDate = new Date();
        const startSnowflakes = new Date(currentDate.getFullYear(), 11, 1); // 1 декабря
        const endSnowflakes = new Date(currentDate.getFullYear(), 0, 30); // 30 января следующего года

        // Если сейчас декабрь или январь, показываем снежинки
        if (currentDate >= startSnowflakes || currentDate <= endSnowflakes) {
            this.showSnowflakes = true;
        }
    }
}
</script>

<template>
    <Snowflakes v-if="showSnowflakes"/>
    <div class="container">
        <video
            autoplay
            muted
            loop
            class="background-video"
            poster="/storage/assets/images/background.jpg">
            <source src="/storage/assets/videos/background.mp4" type="video/mp4" />
        </video>
        <div class="overlay">
            <slot/>
        </div>
    </div>
</template>

<style scoped>
.container {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
}

.background-video {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -1;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(24px);
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 10px;
}
</style>
