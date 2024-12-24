<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import Logo from "@/Components/Logo.vue";
import IconButton from "@/Components/IconButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {
        AuthenticatedLayout,
        GuestLayout,
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
        <transition name="fade">
            <section v-if="loaded" class="buttons">
                <IconButton icon="book">
                    <template #label>
                        Правила
                    </template>
                </IconButton>
                <IconButton icon="map">
                    <template #label>
                        Карта
                    </template>
                </IconButton>
                <GuestLayout v-if="!$page.props.auth.user"/>
                <AuthenticatedLayout v-else/>
            </section>
        </transition>
    </HomeLayout>
</template>

<style scoped>
    .logo {
        position: absolute;
    }
    .logo.active {
        transform: translateY(-200px);
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s linear;
    }
    section.buttons {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 35px;
        width: max-content;
        flex-wrap: wrap; /* Если нужно, чтобы элементы переносились */
    }
</style>
