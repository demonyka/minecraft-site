<script>
import {useForm} from "@inertiajs/vue3";
import {showMessage} from "@/scripts.js";

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
                    showMessage(error);
                });
                this.form.reset('password');
                return;
            }
            this.form.post(route('auth.login'), {
                onError: (errors) => {
                    Object.values(errors).forEach((error) => {
                        showMessage(error);
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
        <input
            type="text"
            placeholder="Никнейм"
            v-model="form.username"
            :class="{'error': form.errors.username }"
            @input="form.clearErrors('username')"
        />
        <input
            type="password"
            placeholder="Пароль"
            v-model="form.password"
            :class="{'error': form.errors.password }"
            @input="form.clearErrors('password')"
        >
        <input :disabled="form.processing" type="submit" value="Войти"/>
    </form>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 10px;
    }
    form > input {
        width: 100%;
        padding: 15px;
        background-color: var(--bg-color);
        border: 1px solid transparent;
        border-radius: 12px;
        font-size: 16px;
        outline: none;
        color: var(--text-color);
    }
    form > input[type="submit"] {
        background-color: var(--primary-color);
        cursor: pointer;
    }
    form > input[type="submit"]:hover {
        opacity: 0.7;
    }
    form > input[type="submit"]:disabled {
        opacity: 0.7;
    }
    form > input.error {
       border-color: lightcoral !important;
    }
</style>
