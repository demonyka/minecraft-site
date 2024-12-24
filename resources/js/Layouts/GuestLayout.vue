<script>
import McButton from "@/Components/McButton.vue";

export default {
name: "GuestLayout",
    components: {McButton}
}
</script>

<template>
    <McButton @click="$inertia.visit(route('auth.login'))">Авторизация</McButton>
</template>

<style scoped>

</style>
