<template>
    <div class="review">
        <div class="top">
            <img class="quotes" alt="" src="/img/icons/quotes-5cbe72.svg">
        </div>
        <div class="text" v-html="text" v-if="text"></div>
        <div class="bottom">
            <div class="name">{{ name }}</div>
            <div class="stars">
                <img class="star" v-for="n in 5" :src="'/img/icons/star-'+((n <= star) ? 'ff9100' : 'f9ecf8')+'.svg'">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "review",
        props: {
            name: {
                type: String,
                required: true,
            },
            star: {
                required: true,
            },
            text: {
                type: String,
                required: false,
            },
        },
    }
</script>

<style scoped>
    .review {
        line-height: 1.685;
    }
    .review:not(:last-child) {
        margin: 0 0 1em;
    }
    .top {
        display: flex;
        align-items: center;
        margin: 0 0 0.5em;
    }
    .quotes {
        width: 1.5em;
        margin-right: 0.375em;
    }
    .top:after {
        content: '';
        display: block;
        height: 1px;
        width: calc(100% - 1.875em);
        background-color: #CCCCCC;
    }
    .text {
        letter-spacing: -0.04em;
        color: #808086;
        font-size: 0.875em;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .bottom {
        display: flex;
        align-items: center;
        margin-top: 0.5em;
    }
    .name {
        font-weight: 600;
    }
    .stars {
        display: flex;
        align-items: center;
        margin-left: 0.75em;
    }
    .star {
        height: 0.75em;
        margin: 1px;
    }
</style>