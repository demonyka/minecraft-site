<script>
export default {
    name: "McContainer",
    props: ['type'],
    methods: {
        click() {
            this.$emit("click");
        }
    }
}
</script>

<template>
    <button :type="type" @click="click" disabled>
        <slot/>
    </button>
</template>

<style scoped>
    button {
        cursor: default;
        font-family: "Minecraft", sans-serif;
        color: white;
        border-color: #AAA #565656 #565656 #AAA;
        text-shadow: 3px 3px #4C4C4C;
        outline: 2px solid #000;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: center;
        padding: .25rem .25rem;
        margin-left: auto;
        margin-right: auto;
        font-size: 100%;
        box-sizing: border-box;
        height: 3rem; /* Установите фиксированную высоту для кнопки */
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAAAPCAAAAACe4j/AAAAEuElEQVRIx1WWS5Ibuw5EtddrdRRJJE4iSKrb4c2/AUuy30iK+jEBHCTwAICMCgAKiGhKVQUwKzJHQo4mQGBy7AIvk1E2AQKhFt6bUGD1gILy0DkD4dmzACkGyzCScgFgQmLZr4LpQpC56QB2wgSYE8i1fd6xd1yPHIAKwAs14Undx2LIHK0X6vdFbzTa6CNBLQE8Y5rapn7oAl3KSDKC6cLfL6sLnIVG7ffnyUgvQ6rwLjUZdIVqWz0iEXXCZ+TJsV8feUdoPHDk+a/IeAbq0ldLT59jtHweHwmKS6gFSUYCqKcVsPami1pEnqolkCMBiAS87FXTICp03geYUr8TV8un3KuyC0BfTUzihOCdwjUya1bkT9VWe+AaFOoJzHdtERXRe/eulyEDhC6pjYwr+JQuIDU9/0wQBnJEAkd+9i6IRTJrV7YWnGfwLA6ESphkBoCu88M0YH1CTTOiRUpDdwpGkkP5yL9phhwn+QVxDarAXq513y9bLKgxBGR/CjDyMl4ECd6lO82CaMLbEHGHp1R8ePDERj392ssaCOigNjJ+dXXl6OLUFfVx6dA1BFJLlHpkUHPam095C3QJLIjn6OLIOB3xe0JS85Zd+govg1/z/UhtG3RdVW98yxNp5I0Vtf/U+6y/dJ/yHtSK4q7G9ARscC3/Df/kXTwiT3d6ovjEISLJIVEvBwWeCXlALZTbpy85xqWuf3sNiBBUmYjI+BqN6aNQqDWpipSYf3W1nOV/WALoykjIiCPreSn97UigsjZdPA5s3AmCDIxaVO0Fa1fV/qkaiijPPz/bEeRyLSBDI8K8j37TO8aH7vmOqUUQ1DboYhvqd+FlFGEo+2T75MbLGnjvPeu7Pl521Ap14dcR3h7p75qv4xieqnNDoyCPLt/yKkf5gOUXl+6S3d9Syq/982fz+fhpsm28C5EhJcxsWWQke6KoPMA7tqm7kKcrn6FLhWcoqCNCxDPyQ8wEKR73nIlEX8GpARSJX7/rzeNtWPD/Dl2IwtOYMwV7osGsHYJanzeU7KqIZVCTcrT0IEbyD4d1e1dkBtW2qLhLXK7a1ogDqsjI1DR4PY7nHEqfF9tn8HUJL+eQ/lGOXdwI1++57CqgmDaReM9CZYLAk4D4ymqti4KZI9Htz9OnrcuOhCQEqJfXaxHPAFG/l/ee1GFJPXmPryYUiUGPutnRGXkagmnjHk5RNpm7xxiclm6CjJEQ4+MD4xPmuT9Ef4b3YT3B51a7d4Np76PF0cavuC+SoaH6PlilipEakoJBJETWT3k7Hf+1REPj2fIx95t5ct6u9S5v3KM2fv2Ve29ax9yC98zT2IZot61MHyYtdPF92nguZ29xfcVxSu9Nj5Gl8G3wcVoW8n1Q/f6BHFEAyy5R2aRIdYH8XfV4453vHKcnqarXPD6mdrD0rlVV5xBPF2xuJM5Oo0SdaaqGMjJva7ii6bYv74IzPMo5pGebpu72ghypwTR+WWDuhQOkFijGyAzF3GXh11lEH0hkPINZivpTqLEtVm2j1hVcn/S0//q0es5dbyxOErxKivQ+bHotvzcT3/XztPf20XqG6fJZMePT2X6ts+nlm9LoSYHMiHuJjGXniB7v2fo/5qT4nuxYg6AAAAAASUVORK5CYII=');
    }
</style>
