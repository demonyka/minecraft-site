<script>
import McButton from "@/Components/McButton.vue";
import * as skinview3d from 'skinview3d';
import McContainer from "@/Components/McContainer.vue";

export default {
    name: "SkinContainer",
    components: {McContainer, McButton},
    methods: {
        async loadSkin() {
            const skinPath = this.$page.props.auth.user.skin_path ?? '/storage/skins/default.png';
            const capePath = route('api.storage.cape', { username: this.$page.props.auth.user.username });
            let skinViewer = new skinview3d.SkinViewer({
                canvas: document.getElementById("skinContainer"),
                width: 376,
                height: 576,
                skin: skinPath,
            });
            skinViewer.autoRotate = true;
            skinViewer.autoRotateSpeed = 0.25;
            skinViewer.animation = new skinview3d.IdleAnimation();
            skinViewer.controls.enableZoom = false;
            skinViewer.nameTag = this.$page.props.auth.user.username;
            skinViewer.fov = 90;
            skinViewer.zoom = 0.75;
        },
    },
    mounted() {
        this.loadSkin();
    }
}
</script>

<template>
    <McContainer class="container">
        <div class="skin-bg">
            <canvas id="skinContainer"></canvas>
            <div class="buttons">
                <McButton class="download-button">
                    <i class="fa download"/>
                </McButton>
            </div>
        </div>
    </McContainer>
</template>

<style scoped>
    @import '@south-paw/typeface-minecraft/index.css';
    .container {
        cursor: default;
        padding: 10px;
        min-width: 400px;
        width: 400px;
        height: 600px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .skin-bg {
        background: black;
        display: flex;
        justify-content: center;
        align-items: center;
        min-width: 376px;
        width: 376px;
        height: 576px;
        position: relative;
    }
    .buttons {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
    .download-button {
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .download-button > i {
        width: 32px;
        height: 32px;
    }
</style>
