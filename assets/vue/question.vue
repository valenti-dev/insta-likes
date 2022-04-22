<template>
    <div class="question" :class="opened ? 'opened' : ''">
        <div class="title" @click="opened = !opened">
            <div class="label">
                <slot name="question"></slot>
            </div>
        </div>
        <div class="content_wrap">
            <div class="content">
                <slot name="answer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "question",
        data() {
            return {
                opened: false,
            };
        },
    }
</script>

<style scoped>
    .question {
        background-color: #ffffff;
        padding: 0;
        box-sizing: border-box;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        border-radius: 1.25em;
        overflow: hidden;
        transition-property: box-shadow;
        transition-duration: 0.3s;
    }
    .question:active {
        box-shadow: none;
    }
    .title {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 1.25em 1.5em 1.25em 1.75em;
    }
    .title:after {
        content: '';
        display: block;
        width: 1.25em;
        height: 1.25em;
        margin-left: 0.25em;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url(/img/icons/plus-5cbe72.svg);
    }
    .question.opened .title:after {
        background-image: url(/img/icons/minus-5cbe72.svg);
    }
    .label {
        letter-spacing: -0.02em;
        line-height: 1.15;
        font-weight: 600;
        font-size: 1.5em;
        width: calc(100% - 1em);
    }
    .content_wrap {
        padding: 0 1.5em 1.25em 1.75em;
        margin: -0.25em;
        display: none;
    }
    .content {
        font-size: 0.875em;
        color: #808086;
        letter-spacing: -0.04em;
        line-height: 1.685;
    }
    .question.opened .content_wrap {
        display: block;
    }
    @media(max-width: 767px) {
        .label {
            font-size: 1.125em;
            width: calc(100% - 1.333334em);
        }
        .title {
            padding: 0.75em 1.5em 0.75em 1.25em;
        }
    }
</style>