<script>
import RegisterForm from "@/Pages/Auth/Partials/RegisterForm.vue";
import LoginForm from "@/Pages/Auth/Partials/LoginForm.vue";

export default {
    components: {LoginForm, RegisterForm},
    data() {
        return {
            section: 'login'
        }
    }
}
</script>

<template>
    <div class="card">
        <h1>MiNEON</h1>
        <div class="buttons">
            <button
                @click="section = 'login'"
                :disabled="section === 'login'"
            >
                Авторизация
            </button>
            <button
                @click="section = 'register'"
                :disabled="section === 'register'"
            >
                Регистрация
            </button>
        </div>

        <LoginForm
            v-show="section === 'login'"
        />
        <RegisterForm
            v-show="section === 'register'"
            @registered="section = 'login'"
        />
    </div>
</template>

<style scoped>
    .card {
        width: 80%;
        max-width: 500px;
        min-width: 300px;
        padding: 20px;
        background-color: var(--block-bg-color);
        border-radius: var(--block-border-radius);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    h1 {
        color: var(--text-color);
    }
    .buttons {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .buttons > button {
        background: none;
        border: none;
        padding: 5px 15px;
        cursor: pointer;
        color: #ffffff90;
        border-radius: var(--block-border-radius);
    }
    .buttons > button:disabled {
        background-color: #00000030;
        color: #ffffff60;
    }
</style>
