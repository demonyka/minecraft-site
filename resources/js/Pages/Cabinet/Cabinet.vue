<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import {Head} from "@inertiajs/vue3";
import SkinContainer from "@/Pages/Cabinet/Partials/SkinContainer.vue";
import McButton from "@/Components/McButton.vue";
import McContainer from "@/Components/McContainer.vue";
import InfoContainer from "@/Pages/Cabinet/Partials/InfoContainer.vue";
import TopupBalance from "@/Pages/Cabinet/Partials/TopupBalance.vue";

export default {
    components: {
        TopupBalance,
        InfoContainer,
        McContainer,
        McButton,
        SkinContainer,
        Head,
        HomeLayout
    }
}
</script>

<template>
    <Head title="Личный кабинет" />
    <HomeLayout>
        <McButton class="back-button" @click="$inertia.visit(route('home'))">
            <i class="fa arrow"/>
        </McButton>
        <div class="cabinet-container">
            <SkinContainer class="skin-container" />
            <div class="cabinet-buttons">
                <InfoContainer/>
                <TopupBalance/>
            </div>
        </div>
    </HomeLayout>
</template>

<style scoped>
    .cabinet-container {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        gap: 10px;
        width: 60%;
    }
    .cabinet-buttons {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
    }
    .back-button {
        position: absolute;
        width: 48px;
        height: 48px;
        left: 24px;
        top: 24px;
    }
    @media (max-width: 1500px) {
        .cabinet-container {
            width: 70%;
        }
    }
    @media (max-width: 1300px) {
        .cabinet-container {
            width: 80%;
        }
    }
    @media (max-width: 1000px) {
        .skin-container {
            display: none;
        }
    }
</style>
