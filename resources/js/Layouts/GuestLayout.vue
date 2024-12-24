<script>
import IconButton from "@/Components/IconButton.vue";
import AuthModal from "@/Components/Auth/AuthModal.vue";

export default {
    name: "GuestLayout" ,
    components: {AuthModal, IconButton},
    data() {
        return {
            currentModal: null,
        }
    },
    methods: {
        closeModal() {
            this.currentModal = null;
        }
    }
}
</script>

<template>
    <IconButton @click="currentModal = 'login'" icon="login">
        <template #label>
            Вход
        </template>
    </IconButton>
    <transition-group name="fade">
        <AuthModal
            @close="closeModal"
            v-if="currentModal === 'login'"
        />
    </transition-group>
</template>

<style scoped>

</style>
