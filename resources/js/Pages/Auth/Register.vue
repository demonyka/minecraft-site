<script>
import McInput from "@/Components/McInput.vue";
import McButton from "@/Components/McButton.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {showAchievement, showMessage} from "@/scripts.js";
import Checkmark from "@/Components/Icons/Checkmark.vue";

export default {
    components: {
        Head,
        McInput,
        McButton,
    },
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
            if (!this.form.email.length > 0) {
                this.form.setError('email', "Почта обязательна к заполнению");
            }
            if (this.form.email.length > 255) {
                this.form.setError('email', "Длина почты не может превышать 255 символов")
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
                    showMessage(error);
                });
                this.form.reset('password_confirmation');
                return;
            }
            this.form.post(route('auth.register'), {
                onSuccess: (data) => {
                    showAchievement('Аккаунт успешно зарегистрирован', Checkmark);
                    this.form.reset();
                    this.$emit('registered')
                },
                onError: (errors) => {
                    Object.values(errors).forEach((error) => {
                        showMessage(error);
                        this.form.reset('password_confirmation');
                    })
                }
            })
        }

    }
}
</script>

<template>
    <Head title="Регистрация"/>
    <div class="container">
        <h1>Регистрация</h1>
        <form @submit.prevent="submit" spellcheck="false" autocomplete="off">
            <McInput
                v-model="form.username"
                label="Никнейм"
                name="username"
                :invalid="form.errors.username"
                @input="form.clearErrors('username')"
            />
            <McInput
                style="margin-top: 12px"
                v-model="form.email"
                name="email"
                label="Адрес электрнной почты"
                :invalid="form.errors.email"
                @input="form.clearErrors('email')"
            />
            <McInput
                style="margin-top: 12px"
                v-model="form.password"
                label="Пароль"
                name="new-password"
                :invalid="form.errors.password"
                type="password"
                @input="form.clearErrors('password')"
            />
            <McInput
                style="margin-top: 12px"
                v-model="form.password_confirmation"
                label="Подтверждение пароля"
                name="new-password"
                :invalid="form.errors.password_confirmation"
                type="password"
                @input="form.clearErrors('password_confirmation')"
            />
            <McButton type="submit" style="margin-top: 6px">Зарегистрироваться</McButton>
            <McButton type="button" @click="$inertia.visit(route('auth.login'))">Уже есть аккаунт?</McButton>
        </form>
    </div>
</template>

<style scoped>
    h1, p, input, button {
        font-family: "Minecraft", sans-serif;
        color: white;
    }
    .container {
        position: fixed;
        width: 100%;
        height: 100%;
        background-image: url("/storage/assets/images/dirt.png");
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
    }
    .container h1 {
        font-size: 18px;
    }
    .container::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: -1;
    }
    form {
        width: 28rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    .sub-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        gap: 12px;
    }
</style>
