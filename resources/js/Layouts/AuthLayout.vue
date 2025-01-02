<script>
import McButton from "@/Components/McButton.vue";

export default {
    name: "AuthLayout",
    components: {McButton}
}
</script>

<template>
    <McButton @click="$inertia.visit(route('cabinet'))">Профиль</McButton>
    <McButton
        class="last-element"
        @click="$inertia.visit(route('auth.logout'))"
    >
        Выход
    </McButton>
</template>

<style scoped>
    .last-element {
        order: 9999;
        margin-top: 24px
    }
</style>
