<script>
export default {
    name: "Logo"
}
</script>

<template>
    <picture class="logo"/>
</template>

<style scoped>
    picture.logo {
        background-image: url('/storage/assets/images/minecraft_title.png');
        width: 512px;
        aspect-ratio: 1024 / 279;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
