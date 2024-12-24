<script>
import IconButton from "@/Components/IconButton.vue";

export default {
    name: "AuthenticatedLayout" ,
    components: {IconButton}
}
</script>

<template>
    <IconButton @click="$inertia.visit(route('auth.logout'))" icon="logout">
        <template #label>
            Выход
        </template>
    </IconButton>
</template>

<style scoped>

</style>
