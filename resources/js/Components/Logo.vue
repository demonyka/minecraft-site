<script>
export default {
    name: "Logo",
    data() {
        const splashes = [
            "пвп пве",
            "mineon 10.0",
            "где коммиты",
            "где мои алмазы?",
            "майнкрафт приколы",
            "made on kolenka",
            "300к наносек",
            "гамарджоба",
            "намасте",
            "савадикап",
            "не бита не крашена",
            "stay alive",
            "все для вас"
        ]
        return {
            splash: splashes[Math.floor(Math.random() * (splashes.length))],
        }
    }
}
</script>

<template>
    <div class="logo">
        <div class="splash">
            <p class="splash">{{ splash }}</p>
        </div>
    </div>
</template>

<style scoped>
    .logo {
        background-image: url('/storage/assets/images/minecraft_title.png');
        width: 512px;
        aspect-ratio: 1024 / 279;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    div.splash {
        right: 40px;
        bottom: 10px;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 0;
        height: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    p.splash {
        rotate: -15deg;
        color: #FDFE07;
        font-size: 24px;
        font-family: Minecraft, sans-serif;
        text-shadow: 3px 3px #4C4C4C;
        animation: splash .8s linear infinite;
        text-wrap: nowrap;
    }
    @keyframes splash {
        0, 100% {
            scale: 1;
        }
        50% {
            scale: 1.1;
        }
    }
</style>
