<template>
    <form class="search" @submit.prevent="submit">
        <span class="placeholder" v-if="placeholder && !query">{{ placeholder }}</span>
        <input type="text" class="input" v-model="query">
        <button class="btn"></button>
    </form>
</template>

<script>
    export default {
        name: "search",
        props: {
            value: {
                type: String,
                default: '',
            },
            placeholder: {
                type: String,
                default: '',
            },
        },
        data() {
            return {
                query: '',
            };
        },
        mounted() {
            this.query = this.value;
        },
        methods: {
            submit() {
                this.$emit('input', this.query);
            },
        },
    }
</script>

<style scoped>
    .search {
        background-color: #ffffff;
        height: 4em;
        border-radius: 2em;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        position: relative;
        box-sizing: border-box;
        max-width: 100%;
        padding: 0 4.375em 0 1.75em;
        z-index: 1;
        letter-spacing: -0.02em;
        line-height: 1.15;
    }
    .placeholder {
        display: block;
        position: absolute;
        top: 50%;
        left: 1.75em;
        max-width: calc(100% - 6.125em);
        color: #808086;
        transform: translate(0, -50%);
    }
    .input {
        height: 100%;
        font-size: inherit;
        line-height: inherit;
        width: 100%;
        font-family: inherit;
        padding: 0;
        margin: 0;
        border: none;
        color: inherit;
        outline: none;
    }
    .btn {
        font-size: inherit;
        font-family: inherit;
        margin: 0;
        padding: 0;
        top: 50%;
        right: 1em;
        width: 2.5em;
        height: 2.5em;
        transform: translate(0, -50%);
        position: absolute;
        border-radius: 50%;
        border: none;
        background-color: #5CBE72;
        outline: none;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 40% auto;
        background-image: url(/img/icons/search-fff.svg);
        cursor: pointer;
    }
</style>