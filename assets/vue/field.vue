<template>
    <div class="field">
        <div class="input">
            <slot></slot>
        </div>
        <div class="error" v-if="error">{{ error }}</div>
    </div>
</template>

<script>
    export default {
        name: "field",
        props: {
            label: {
                type: String,
                default: '',
            },
            error: {},
        },
    }
</script>

<style scoped>
    .field:not(:last-child) {
        margin-bottom: 1em;
    }
    .field > .error {
        font-size: 0.75em;
        margin: 0.5em 0 0;
        color: #FA655C;
        letter-spacing: -0.02em;
        line-height: 1.15;
        font-weight: 700;
    }
</style>