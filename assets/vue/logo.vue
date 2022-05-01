<template>
    <a href="/" class="logo">
        <img alt="likewave.io buy Instagram likes and followers" :src="'/img/logo'+(type ? ('-'+type) : '')+'.svg'">
    </a>
</template>

<script>
    export default {
        name: "logo",
        props: {
            type: {
                type: String,
            },
        },
    }
</script>

<style scoped>
    .logo {
        display: inline-block;
        line-height: 1;
    }
    img {
        max-height: 3.25em;
        display: block;
    }
    @media(max-width: 767px) {
        img {
            max-height: 2.125em;
        }
    }
</style>