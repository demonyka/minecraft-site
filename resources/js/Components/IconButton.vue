<script>
export default {
    name: "IconButton",
    props: {
        icon: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            uniqueId: `button-${Math.random().toString(36).substr(2, 9)}`
        };
    }
}
</script>

<template>
    <div class="button">
        <button :id="uniqueId">
            <slot v-if="!icon" name="icon"/>
            <i v-else class="fa" :class="icon"/>
        </button>
        <label :for="uniqueId">
            <slot name="label"/>
        </label>
    </div>
</template>

<style scoped>
.button {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
button {
    border: none;
    outline: none;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    cursor: pointer;
}
button:hover {
    background: rgba(255, 255, 255, 0.15);
}
button:hover + label {
    color: rgba(255, 255, 255, 0.8);
}
i {
    filter: contrast(0.5);
    width: 28px;
    height: 28px;
}
label {
    text-align: center;
    width: 100%;
    color: rgba(255, 255, 255, 0.6);
    transition: color 0.3s ease;
    margin-top: 5px;
}
</style>
