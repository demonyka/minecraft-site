<script>
import McButton from "@/Components/McButton.vue";
import McInput from "@/Components/McInput.vue";
import {showMessage} from "@/scripts.js";

export default {
    name: "TopupBalance",
    components: {McInput, McButton},
    data() {
        return {
            showInput: false,
            amount: null,
        }
    },
    methods: {
        createPayment() {
            if (this.amount < 100 || this.amount > 10000) {
                showMessage('Сумма пополнения должна быть от 100 до 10\'000 рублей');
                return;
            }
            axios.get(route('payments.yookassa.create'))
                .then((response) => {
                    const url = response.data.url;
                    window.location.href = url; // Перенаправление на новую страницу
                })
                .catch((error) => {
                    showMessage('Произошла ошибка')
                });
        }
    }
}
</script>

<template>
    <McButton @click="showInput = true" v-if="!showInput">Пополнить баланс</McButton>
    <form @submit.prevent="createPayment" v-else class="topup-balance">
        <McInput type="number" v-model="amount" placeholder="Укажите сумму (в рублях)"/>
        <McButton type="submit" style="width: 50%">Пополнить</McButton>
    </form>
</template>

<style scoped>
    .topup-balance {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 10px;
        width: 100%;
    }
</style>
