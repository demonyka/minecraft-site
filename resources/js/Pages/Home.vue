<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import Logo from "@/Components/Logo.vue";
import IconButton from "@/Components/IconButton.vue";
import {Head} from "@inertiajs/vue3";
import McButton from "@/Components/McButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    components: {
        GuestLayout,
        McButton,
        IconButton,
        Logo,
        HomeLayout,
        Head
    },
    data() {
        return {
            loaded: false
        }
    },
    mounted() {
        setTimeout(() => {
            this.loaded = true;
        }, 1000)
    }
}
</script>

<template>
    <Head title="Главная"/>
    <HomeLayout>
        <Logo class="logo" :class="{'active': loaded}"/>
        <transition-group name="fade">
            <section v-if="loaded">
                <GuestLayout v-if="!$page.props.auth.user"/>
                <McButton>Скачать лаунчер</McButton>
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
