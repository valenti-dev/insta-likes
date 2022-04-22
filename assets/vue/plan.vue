<template>
    <div class="plan">
        <div class="plan_h">
            <div class="qty">{{ count }}</div>
            <div class="name">{{ count }} instagram {{ service }}</div>
            <div class="mark">
                <div class="stars">
                    <img class="star" v-for="n in 5" :src="'/img/icons/star-'+((n <= mark) ? 'ff9100' : 'f9ecf8')+'.svg'">
                </div>
                <a href="#reviews">{{ reviews_qty }} reviews</a>
            </div>
        </div>
        <div class="plan_c">
            <div class="price_wrap">
                <sup v-if="$root.user_info.sym_b">{{ $root.user_info.sym_b }}</sup>
                <span class="price">{{ price }}</span>
                <sup v-if="$root.user_info.sym_a">{{ $root.user_info.sym_a }}</sup>
            </div>
            <div class="attrs_wrap">
                <div class="attr">
                    <img alt="" src="/img/pricing/attr1.svg">
                    High Quality
                </div>
                <div class="attr">
                    <img alt="" src="/img/pricing/attr2.svg">
                    No password needed
                </div>
                <div class="attr">
                    <img alt="" src="/img/pricing/attr3.svg">
                    Drop protection
                </div>
                <div class="attr">
                    <img alt="" src="/img/pricing/attr4.svg">
                    Safe and easy
                </div>
                <div class="attr">
                    <img alt="" src="/img/pricing/attr5.svg">
                    Instant delivery guaranteed
                </div>
                <div class="attr">
                    <img alt="" src="/img/pricing/attr6.svg">
                    24/7 Support
                </div>
            </div>
            <div class="payment">
                <img alt="" src="/img/pricing/pay-icon.svg">
                Secure payments
            </div>
        </div>
        <butt @click.prevent="select">Buy Now</butt>
    </div>
</template>

<script>
    import Butt from "./butt";
    export default {
        name: "plan",
        components: {Butt},
        props: {
            count: {},
            service: {},
            butt_id: {},
            price: {},
            discount: {},
            reviews_qty: {},
            mark: {},
        },
        methods: {
            select() {
                this.$emit('select');
            },
        },
    }
</script>

<style scoped>
    .plan {
        box-sizing: border-box;
        border: 1px solid #CCCCCC;
        border-radius: 1.25em;
        margin: 0 0.75em 2em !important;
        padding-top: calc(0.25em - 1px);
        position: relative;
        width: calc(100% - 1.5em) !important;
        background-color: #ffffff;
        transition-property: box-shadow, border-top, padding-top;
        transition-duration: 0.3s;
    }
    .plan:hover {
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        border-top: 0.25em solid #5CBE72;
        padding-top: 0;
    }
    .plan_h {
        padding: 0.5em 1em 1em;
        box-sizing: border-box;
        border-bottom: 1px solid #CCCCCC;
        text-align: center;
    }
    .qty {
        color: #5CBE72;
        letter-spacing: -0.02em;
        font-weight: 700;
        line-height: 1.15;
        font-size: 1.875em;
    }
    .name {
        line-height: 1.685;
        font-weight: 600;
        text-transform: lowercase;
    }
    .mark {
        font-size: 0.75em;
    }
    .stars {
        margin: 0 0.5em 0 0;
        display: inline-flex;
    }
    .star {
        height: 0.75em;
    }
    .mark a {
        color: #808086;
    }
    .plan_c {
        padding: 0 0 3em;
    }
    .price_wrap {
        text-align: center;
        line-height: 1.15;
        background-color: #F4F9F5;
        font-weight: 700;
        letter-spacing: -0.02em;
        font-size: 2.75em;
        padding: 0.2em 0;
        color: #5CBE72;
    }
    .price_wrap sup {
        font-size: 0.5em;
    }
    .attrs_wrap {
        padding: 0 1.75em;
        line-height: 1.685;
    }
    .attr {
        border-bottom: 1px solid #CCCCCC;
        height: 3.6em;
        box-sizing: border-box;
        display: flex;
        text-align: center;
        align-items: center;
        font-size: 0.875em;
        justify-content: center;
    }
    .attr:first-child {
        border-top: 1px solid #CCCCCC;
    }
    .attr img {
        height: 1em;
        margin-right: 0.25em;
    }
    .payment {
        font-weight: 700;
        text-align: center;
        color: #21B654;
        line-height: 1.685;
        padding: 0.75em 0;
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .payment img {
        height: 0.75em;
        margin-right: 0.25em;
    }
    .butt {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: calc(100% - 4em);
    }
</style>