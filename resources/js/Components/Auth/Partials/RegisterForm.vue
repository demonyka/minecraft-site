<script>
import {showError, showMessage} from "@/scripts.js";
import {useForm} from "@inertiajs/vue3";

export default {
    name: "RegisterForm",
    data() {
        return {
            form: useForm({
                username: "",
                email: "",
                password: "",
                password_confirmation: "",
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
            if (this.form.email.length > 255) {
                this.form.setError('email', "Длина почты не может превышать 255 символов");
            }
            if (!this.form.email) {
                this.form.setError('email', "Почта обязательна к заполнению");
            }
            if (this.form.password.length < 6) {
                this.form.setError('password', "Длина пароля не может быть меньше 6 символов");
            }
            if (this.form.password.length > 64) {
                this.form.setError('password', "Длина пароля не может превышать 64 символов");
            }
            if (this.form.password !== this.form.password_confirmation) {
                this.form.setError('password_confirmation', "Пароли не совпадают");
            }

            if (this.form.hasErrors) {
                Object.values(this.form.errors).forEach((error) => {
                    showError(error);
                });
                this.form.reset('password_confirmation');
                return;
            }
            this.form.post(route('auth.register'), {
                onSuccess: (data) => {
                    showMessage('Аккаунт успешно зарегистрирован');
                    this.form.reset();
                    this.$emit('login')
                },
                onError: (errors) => {
                    Object.values(errors).forEach((error) => {
                        showError(error);
                        this.form.reset('password_confirmation');
                    })
                }
            })
        }
    }
}
</script>

<template>
    <form @submit.prevent="submit">
        <h1>Регистрация</h1>
        <input
            placeholder="Никнейм"
            v-model="form.username"
            :class="{'error': form.errors.username}"
            @input="form.clearErrors('username')"
        />
        <input
            placeholder="Почта"
            v-model="form.email"
            :class="{'error': form.errors.email}"
            @input="form.clearErrors('email')"
        />
        <input
            placeholder="Пароль"
            type="password"
            v-model="form.password"
            :class="{'error': form.errors.password}"
            @input="form.clearErrors('password')"
        />
        <input
            placeholder="Подтверждение пароля"
            type="password"
            v-model="form.password_confirmation"
            :class="{'error': form.errors.password_confirmation}"
            @input="form.clearErrors('password_confirmation')"
        />
        <input type="submit" value="Зарегистрироваться">
        <button @click="$emit('login')" type="button" class="text">Уже есть аккаунт?</button>
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
