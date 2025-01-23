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

    },
    methods: {
        formatBalance(balance) {
            return parseFloat(balance).toString();
        }
    }
}
</script>

<template>
    <McContainer class="cabinet-info">
        <p>Почта: {{ $page.props.auth.user.email }}</p>
        <p>Дата регистрации: {{ new Date($page.props.auth.user.created_at).toLocaleString('ru') }}</p>
        <p>Баланс: {{ formatBalance($page.props.auth.user.balance) }} руб.</p>
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
