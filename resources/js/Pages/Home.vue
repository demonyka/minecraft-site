<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import Logo from "@/Components/Logo.vue";
import IconButton from "@/Components/IconButton.vue";
import {Head} from "@inertiajs/vue3";
import McButton from "@/Components/McButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Snowflakes from "@/Components/Snowflakes.vue";

export default {
    components: {
        Snowflakes,
        AuthLayout,
        GuestLayout,
        McButton,
        IconButton,
        Logo,
        HomeLayout,
        Head
    },
    data() {
        return {
            loaded: false,
            showSnowflakes: false,
            downloadCooldown: false
        };
    },
    methods: {
        downloadLauncher() {
            if (this.downloadCooldown) {
                return;
            }
            this.downloadCooldown = true;
            const link = document.createElement('a');
            link.href = '/storage/download/Launcher.jar'; // Путь к файлу
            link.download = 'Launcher.jar'; // Имя файла при скачивании
            link.click(); // Инициируем скачивание
            setTimeout(() => {
                this.downloadCooldown = false;
            })
        },
    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const launcher = urlParams.get('launcher');

        if (launcher !== 'true') {
            setTimeout(() => {
                this.loaded = true;
            }, 1000);
        }

        const currentDate = new Date();
        const startSnowflakes = new Date(currentDate.getFullYear(), 11, 1); // 1 декабря
        const endSnowflakes = new Date(currentDate.getFullYear(), 0, 30); // 30 января следующего года

        // Если сейчас декабрь или январь, показываем снежинки
        if (currentDate >= startSnowflakes || currentDate <= endSnowflakes) {
            this.showSnowflakes = true;
        }
    }
};
</script>

<template>
    <Head title="Главная"/>
    <Snowflakes v-if="showSnowflakes"/>
    <HomeLayout>
        <Logo :class="{'active': loaded}" class="logo"/>
        <transition-group name="fade">
            <section v-if="loaded">
                <GuestLayout v-if="!$page.props.auth.user"/>
                <AuthLayout v-else/>
                <McButton @click="downloadLauncher">Скачать лаунчер</McButton>
            </section>
        </transition-group>
    </HomeLayout>
</template>

<style scoped>
.logo {
    position: absolute;
}

.logo.active {
    transform: translateY(-250px);
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 1s linear;
}

section {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
    width: 28rem;
}
</style>
