<script>
export default {
    name: "Modal",
    data() {
        return {
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');

        }
    },
    mounted() {

    },
    watch: {

    }
}
</script>

<template>
    <div class="modal" @click="closeModal">
        <div @click.stop class="modal-content">
            <slot/>
        </div>
    </div>
</template>

<style scoped>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        padding: 24px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        backdrop-filter: blur(24px);
    }
</style>
