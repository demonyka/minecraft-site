<script>
import McContainer from "@/Components/McContainer.vue";

export default {
    name: "InfoContainer" ,
    components: {McContainer},
    data() {
        return {
            status: false,
        }
    },
    mounted() {
        if (this.$page.props.auth.user.whitelisted_until) {
            const whitelistDate = new Date(this.$page.props.auth.user.whitelisted_until);
            if (new Date() < whitelistDate) {
                this.status = true;
            }
        }
    }
}
</script>

<template>
    <McContainer class="cabinet-info">
        <p>Почта: {{ $page.props.auth.user.email }}</p>
        <p>Дата регистрации: {{ new Date($page.props.auth.user.created_at).toLocaleString('ru') }}</p>
        <p>Баланс: {{ $page.props.auth.user.balance }}$</p>
        <p>Пропуск: {{ status ? 'Активен до ' + new Date($page.props.auth.user.whitelisted_until).toLocaleString(): 'Неактивен' }}</p>
    </McContainer>
</template>

<style scoped>
    .cabinet-info {
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 20px;
    }
    .cabinet-info * {
        font-family: "Minecraft", sans-serif;
    }
</style>
