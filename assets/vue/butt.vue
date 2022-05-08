<template>
        <button class="butt" @click="click" :disabled="disabled" v-if="!href" :class="{loading: loading}">
            <span class="load_indicator" v-if="loading" :style="{width: (loading+'%')}"></span>
            <span class="butt_label">
                <template v-if="loading">
                    <span style="color: #252726;">{{ loading }}%</span>
                </template>
                <template v-else>
                    <slot></slot>
                </template>
            </span>
        </button>
        <a class="butt" @click="click" :disabled="disabled" v-else :href="href" :class="{loading: loading}">
            <span class="load_indicator" v-if="loading" :style="{width: (loading+'%')}"></span>
            <span class="butt_label">
                <template v-if="loading">
                    <span style="color: #252726;">{{ loading }}%</span>
                </template>
                <template v-else>
                    <slot></slot>
                </template>
            </span>
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
            loading: {
                default: null,
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
        overflow: hidden;
        z-index: 1;
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
    }
    .butt:not(.loading):disabled {
        opacity: 0.5;
    }
    .butt.loading {
        background-color: #ffffff;
    }
    .load_indicator {
        position: absolute;
        height: calc(100% + 0.5em);
        display: block;
        z-index: -1;
        background-color: #FFC266;
        top: 50%;
        left: 0;
        transform: translate(0, -50%);
        transition-property: width;
        transition-duration: 0.3s;
    }
</style>