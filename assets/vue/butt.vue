<template>
        <button class="butt" @click="click" :disabled="disabled" v-if="!href">
            <span class="butt_label"><slot></slot></span>
        </button>
        <a class="butt" @click="click" :disabled="disabled" v-else :href="href">
            <span class="butt_label"><slot></slot></span>
        </a>
</template>

<script>
    export default {
        name: "butt",
        props: {
            disabled: {
                type: Boolean,
                default: false,
            },
            href: {
                type: String,
                default: '',
            },
        },
        methods: {
            click(event) {
                this.$emit('click', event);
            },
        },
    }
</script>

<style scoped>
    .butt {
        margin: 0;
        display: inline-flex;
        align-items: center;
        padding: 0 2.5em;
        height: 4em;
        background-color: #FFC266;
        cursor: pointer;
        color: #FFFFFF;
        font-size: inherit;
        font-family: inherit;
        font-weight: 600;
        max-width: 100%;
        text-align: center;
        justify-content: center;
        border-radius: 2em;
        box-sizing: border-box;
        text-decoration: none;
        line-height: 1.15;
        border: 0.125em solid #FFC266;
        position: relative;
        transition-property: box-shadow, background-color, color;
        transition-duration: 0.3s;
    }
    .butt_label {
        font-size: 1.25em;
    }
    .butt:not(:disabled):hover {
        background-color: #ffffff;
        color: #FFC266;
    }
    .butt:disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>