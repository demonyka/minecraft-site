<script>
export default {
    name: "McInput",
    props: {
        modelValue: {
            type: String,
            required: false,
            default: ''
        },
        label: {
            type: String,
            required: false,
            default: null
        },
        invalid: {
            type: Boolean,
            required: false,
            default: false
        },
        type: {
            type: String,
            required: false,
            default: 'text'
        }
    },
    methods: {
        // This method will handle content change and emit the updated value
        onInput(event) {

        }
    }
}
</script>

<template>
    <div class="input-group">
        <label :class="{'invalid': invalid}" v-if="label">{{ label }}</label>
        <input
            class="editable"
            @input="$emit('update:modelValue', $event.target.value)"
            :value="modelValue"
            :class="{'invalid': invalid}"
            :type="type"
        />
    </div>
</template>

<style scoped>
.input-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}
label {
    color: gray;
    font-family: "Minecraft", sans-serif;
    line-height: 10px;
}
.editable {
    font-family: "Minecraft", sans-serif;
    color: white;
    background-color: black;
    outline: 2px solid #000;
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    text-align: left;
    margin-left: auto;
    margin-right: auto;
    font-size: 100%;
    box-sizing: border-box;
    line-height: 3rem;
    height: 3rem;
    border: 2px solid #A0A0A0;
    caret-color: transparent;
    -webkit-tap-highlight-color: transparent;
    padding: .9rem 15px .25rem;
}
.editable:focus {
    border-color: white;
}
.editable:focus + label {
    color: white;
}
.editable.invalid {
    border-color: firebrick;
}
label.invalid,
.editable.invalid,
.editable.invalid::placeholder {
    color: firebrick;
}
</style>
