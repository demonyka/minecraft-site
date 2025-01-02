<script>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import Logo from "@/Components/Logo.vue";
import IconButton from "@/Components/IconButton.vue";
import {Head} from "@inertiajs/vue3";
import McButton from "@/Components/McButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Snowflakes from "@/Components/Snowflakes.vue";

export default {
    components: {
        Snowflakes,
        AuthLayout,
        GuestLayout,
        McButton,
        IconButton,
        Logo,
        HomeLayout,
        Head
    },
    data() {
        return {
            loaded: false,
            showSnowflakes: false,
            downloadCooldown: false
        };
    },
    methods: {
        downloadLauncher() {
            if (this.downloadCooldown) {
                return;
            }
            this.downloadCooldown = true;

            // Определяем платформу автоматически
            const userAgent = navigator.userAgent.toLowerCase();
            let platform = 'windows'; // Значение по умолчанию

            if (userAgent.includes('mac')) {
                platform = 'mac';
            } else if (userAgent.includes('linux')) {
                platform = 'linux';
            }

            axios({
                method: 'get',
                url: route('launcher.download'),
                params: { platform }, // Передаем автоматически определенную платформу
                responseType: 'blob', // Получаем файл в бинарном формате
            })
                .then((response) => {
                    const contentDisposition = response.headers['content-disposition'];
                    let filename = 'Launcher'; // Значение по умолчанию

                    // Попробуем извлечь имя файла из заголовков (если сервер его отправляет)
                    if (contentDisposition) {
                        const match = contentDisposition.match(/filename="?(.+?)"?$/);
                        if (match) {
                            filename = match[1];
                        }
                    }

                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = filename; // Используем извлеченное имя файла
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                })
                .catch((error) => {
                    console.error('Ошибка при загрузке файла:', error);
                })
                .finally(() => {
                    setTimeout(() => {
                        this.downloadCooldown = false;
                    }, 5000); // Устанавливаем задержку перед повторной загрузкой
                });
        }
    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const launcher = urlParams.get('launcher');

        if (launcher !== 'true') {
            setTimeout(() => {
                this.loaded = true;
            }, 1000);
        }

        const currentDate = new Date();
        const startSnowflakes = new Date(currentDate.getFullYear(), 11, 1); // 1 декабря
        const endSnowflakes = new Date(currentDate.getFullYear(), 0, 30); // 30 января следующего года

        // Если сейчас декабрь или январь, показываем снежинки
        if (currentDate >= startSnowflakes || currentDate <= endSnowflakes) {
            this.showSnowflakes = true;
        }
    }
};
</script>

<template>
    <Head title="Главная"/>
    <Snowflakes v-if="showSnowflakes"/>
    <HomeLayout>
        <Logo :class="{'active': loaded}" class="logo"/>
        <transition-group name="fade">
            <section v-if="loaded">
                <GuestLayout v-if="!$page.props.auth.user"/>
                <AuthLayout v-else/>
                <McButton @click="downloadLauncher">Скачать лаунчер</McButton>
            </section>
        </transition-group>
    </HomeLayout>
</template>

<style scoped>
.logo {
    position: absolute;
}

.logo.active {
    transform: translateY(-250px);
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 1s linear;
}

section {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
    width: 28rem;
}
</style>
