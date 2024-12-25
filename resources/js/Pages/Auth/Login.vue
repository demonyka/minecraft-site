<script>
import McInput from "@/Components/McInput.vue";
import McButton from "@/Components/McButton.vue";
import {useForm} from "@inertiajs/vue3";
import {Head} from "@inertiajs/vue3";
import {showMessage} from "@/scripts.js";

export default {
    components: {
        McInput,
        McButton,
        Head
    },
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
    <Head title="Авторизация"/>
    <div class="container">
        <h1>Авторизация</h1>
        <form @submit.prevent="submit" spellcheck="false" autocomplete="off">
            <McInput
                v-model="form.username"
                name="username"
                label="Никнейм"
                :invalid="form.errors.username"
                @input="form.clearErrors('username')"
            />
            <McInput
                style="margin-top: 12px"
                v-model="form.password"
                name="password"
                label="Пароль"
                :invalid="form.errors.password"
                type="password"
                @input="form.clearErrors('password')"
            />
            <McButton type="submit" style="margin-top: 6px">Войти</McButton>
            <section class="sub-buttons">
                <McButton type="button" @click="$inertia.visit(route('auth.register'))">Нет аккаунта?</McButton>
                <McButton type="button">Забыли пароль?</McButton>
            </section>
            <McButton type="button" style="margin-top: 32px" @click="$inertia.visit(route('home'))">На главную</McButton>
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
