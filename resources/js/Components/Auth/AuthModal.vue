<script>
import Modal from "@/Components/Modal.vue";
import LoginForm from "@/Components/Auth/Partials/LoginForm.vue";
import RegisterForm from "@/Components/Auth/Partials/RegisterForm.vue";

export default {
    name: "AuthModal",
    components: {RegisterForm,
        LoginForm,
        Modal
    },
    data() {
        return {
            section: "login"
        }
    }
}
</script>

<template>
    <Modal @close="$emit('close')">
        <LoginForm @register="section = 'register'" v-if="section === 'login'"/>
        <RegisterForm @login="section = 'login'" v-else-if="section === 'register'"/>
    </Modal>
</template>

<style scoped>

</style>
