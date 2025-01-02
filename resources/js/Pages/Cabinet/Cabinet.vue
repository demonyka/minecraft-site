<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import {Head} from "@inertiajs/vue3";
import SkinContainer from "@/Pages/Cabinet/Partials/SkinContainer.vue";
import McButton from "@/Components/McButton.vue";
import McContainer from "@/Components/McContainer.vue";

export default {
    components: {
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
        <div class="cabinet-container">
            <SkinContainer class="skin-container" />
            <div class="cabinet-buttons">
                <McContainer class="cabinet-info">

                </McContainer>
                <McButton>Lorem</McButton>
                <McButton>Ipsum</McButton>
                <McButton>Lorem</McButton>
                <McButton>Ipsum</McButton>
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
    .cabinet-info {
        min-height: 200px;
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
