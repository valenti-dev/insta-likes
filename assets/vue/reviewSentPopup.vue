<template>
    <popup @close="close">
        <div class="review_sent_popup">
            <div class="icon_wrap">
                <img class="icon" alt="" src="/img/icons/success-checked.svg">
            </div>
            <div class="title">
                Thank you!
            </div>
            <div class="desc">
                Your review has been successfully sent to us
            </div>
            <div class="butt_wrap">
                <butt href="/">Home page</butt>
            </div>
        </div>
    </popup>

</template>

<script>
    import Butt from "./butt";
    import Popup from "./popup";
    export default {
        name: "reviewSentPopup",
        components: {Popup, Butt},
        methods: {
            close() {
                this.$emit('close');
            },
        },
    }
</script>

<style scoped>
    .review_sent_popup {
        background-color: #ffffff;
        border-radius: 1.25em;
        box-sizing: border-box;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        padding: 3.75em 1.5em;
        text-align: center;
    }
    .review_sent_popup .icon_wrap {
        margin: 0 0 1.75em;
    }
    .review_sent_popup .icon_wrap .icon {
        display: block;
        width: 7.25em;
        margin: 0 auto;
    }
    .title {
        font-weight: 900;
        font-size: 2.75em;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        line-height: 1.25;
        margin: 0 0 0.25em;
    }
    .desc {
        letter-spacing: -0.04em;
        line-height: 1.685;
        color: #808086;
        font-size: 1.375em;
        margin: 0 0 0.75em;
    }
    @media(max-width: 1199px) {
        .title {
            font-size: 2.25em;
        }
    }
    @media(max-width: 767px) {
        .review_sent_popup {
            padding: 2.75em 1.25em;
        }
        .title {
            font-size: 1.5em;
        }
    }
</style>