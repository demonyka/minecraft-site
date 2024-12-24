<script>
import {showError} from "@/scripts.js";
import {useForm} from "@inertiajs/vue3";

export default {
    name: "LoginForm",
    data() {
        return {
            form: useForm({
                username: "",
                password: "",
            })
        }
    },
    methods: {
        submit() {
            this.form.clearErrors();
            if (this.form.username.length > 16) {
                this.form.setError('username', "Длина никнейма не может превышать 16 символов");
            }
            if (this.form.username.length < 4) {
                this.form.setError('username', "Длина никнейма не может быть меньше 4 символов");
            }
            if (this.form.password.length < 6) {
                this.form.setError('password', "Длина пароля не может быть меньше 6 символов");
            }
            if (this.form.password.length > 64) {
                this.form.setError('password', "Длина пароля не может превышать 64 символов");
            }

            if (this.form.hasErrors) {
                Object.values(this.form.errors).forEach((error) => {
                    showError(error);
                });
                this.form.reset('password');
                return;
            }
            this.form.post(route('auth.login'), {
                onError: (errors) => {
                    Object.values(errors).forEach((error) => {
                        showError(error);
                        this.form.reset('password');
                    })
                }
            })
        }
    }
}
</script>

<template>
    <form @submit.prevent="submit">
        <h1>Авторизация</h1>
        <input
            placeholder="Никнейм"
            v-model="form.username"
            :class="{'error': form.errors.username}"
            @input="form.clearErrors('username')"
        />
        <input
            placeholder="Пароль"
            type="password"
            v-model="form.password"
            :class="{'error': form.errors.password}"
            @input="form.clearErrors('password')"
        />
        <input type="submit" value="Войти">
        <button type="button" @click="$emit('register')" class="text">Зарегистрироваться</button>
    </form>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    form {
        width: 100%;
        min-width: 300px;
        max-width: 500px;
    }
    form > input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid transparent;
        outline: none;
        background: rgba(0, 0, 0, 0.2);
        color: #fff;
        font-size: 18px;
        border-radius: 8px;
    }
    form > input[type="submit"] {
        cursor: pointer;
    }
    form > input.error {
        border-color: firebrick;
        color: firebrick;
    }
    form > input.error::placeholder {
        color: firebrick;
    }
</style>
