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

            const userAgent = navigator.userAgent.toLowerCase();
            let platform = 'default';

            if (userAgent.includes('mac')) {
                platform = 'mac';
            } else if (userAgent.includes('linux')) {
                platform = 'linux';
            }

            const paths = {
                'linux': '/storage/download/Launcher/Launcher.jar',
                'mac': '/storage/download/Launcher/Launcher.jar',
                'windows': '/storage/download/Launcher/Launcher.exe'
            };

            const names = {
                'linux': 'MiNEON.jar',
                'mac': 'MiNEON.jar',
                'windows': 'MiNEON.exe',
            }

            this.downloadFile(paths[platform], names[platform]);
        },

        downloadFile(path, name) {
            const link = document.createElement('a');
            link.href = path;
            link.download = name;
            link.click();
        }

    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const launcher = urlParams.get('launcher');

        if (launcher !== 'true') {
            setTimeout(() => {
                this.loaded = true;
            }, 1000);
        }
    }
};
</script>

<template>
    <Head title="Главная"/>
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
