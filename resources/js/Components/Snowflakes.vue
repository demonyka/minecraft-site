<script>
export default {
    name: "Snowflakes",
    data() {
        const totalSnowflakes = 30;
        return {
            snowflakes: Array.from({ length: totalSnowflakes }, (_, i) => ({
                id: i,
                img: `/storage/assets/images/snowflakes/snowflake${Math.floor(Math.random() * 3) + 1}.png`,
                scale: (Math.random() * 0.5 + 0.75).toFixed(2), // Scale between 0.75 and 1.25
                left: `${Math.random() * 98}%`,
                fallDelay: `-${Math.random() * 9}s`,
                shakeDelay: `${Math.random() * 3}s`,
                fallDuration: `${Math.random() * 7 + 7}s` // Duration between 7 and 14 seconds
            }))
        };
    }
};
</script>

<template>
    <div class="snow-container">
        <div v-for="snowflake in snowflakes" :key="snowflake.id" class="snowflake" :style="{ left: snowflake.left, animationDelay: snowflake.shakeDelay }">
            <div class="inner" :style="{ transform: `scale(${snowflake.scale})`, animationDelay: snowflake.fallDelay, animationDuration: snowflake.fallDuration }">
                <img :src="snowflake.img" alt="Snowflake" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.snow-container {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 100;
}
.snowflake {
    position: fixed;
    top: -10%;
    animation: snowflakes-shake 3s ease-in-out infinite;
    z-index: 9999;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}
.snowflake .inner {
    animation: snowflakes-fall 10s linear infinite;
}
.snowflake .inner img {
    object-fit: cover;
}

@keyframes snowflakes-fall {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(110vh);
    }
}

@keyframes snowflakes-shake {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(80px);
    }
}
</style>
