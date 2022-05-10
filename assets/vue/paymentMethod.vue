<template>
    <div class="payment_method" :class="{
        green: (discount > 0),
        red: (discount < 0),
    }" @click="click">
        <div class="logo"></div>
        <div class="data">
            <div class="name">{{ name }}</div>
            <div class="prices">
                <div class="discount">
                    <template v-if="price_local">
                        {{ $root.user_info.sym_b }}{{ price_local }}{{ $root.user_info.sym_a }}
                    </template>
                    <template v-else>
                        ${{ price_usd }}
                    </template>
                </div>
                <div class="tax" v-if="+tax">+ {{ tax }}% Vat</div>
            </div>
        </div>

        <div class="discount_percentage">
            <span>{{ discount }}%</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "paymentMethod",
        props: {
            name: {},
            tax: {},
            url_to_pay: {},
            modal: {},
            discount: {},
            price_local: {},
            price_usd: {},
        },
        methods: {
            click() {
                if(this.modal) {
                    window.open(this.url_to_pay);
                } else {
                    location.href = this.url_to_pay;
                }
            },
        },
    }
</script>

<style scoped>
    .payment_method {
        box-sizing: border-box;
        height: 6.25em;
        border-radius: 2em;
        border: 1px solid #CCCCCC;
        background-color: #ffffff;
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 1em;
        position: relative;
        transition-property: border-color, box-shadow;
        transition-duration: 0.3s;
    }
    .payment_method:not(:last-child) {
        margin-bottom: 1.25em;
    }
    .payment_method:hover {
        border-color: transparent;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
    }
    .logo {
        width: 2.75em;
        height: 2.75em;
        box-sizing: border-box;
        border-radius: 50%;
        border: 1px solid #C4C4C4;
        background-size: 50% auto;
        background-position: center;
        background-repeat: no-repeat;
        margin-right: 1em;
        background-image: url(/img/icons/cryprocarrency.svg);
    }
    .discount_percentage {
        width: 2.75em;
        height: 2.75em;
        box-sizing: border-box;
        border-radius: 50%;
        border: 1px solid #C4C4C4;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #C4C4C4;
        font-weight: 600;
        background-color: #ffffff;
    }
    .payment_method.red .discount_percentage {
        border-color: #FA655C;
        color: #FA655C;
        background-color: #FFF3F2;
    }
    .payment_method.green .discount_percentage {
        border-color: #5CBE72;
        color: #5CBE72;
        background-color: #F4F9F5;
    }
    .discount_percentage span {
        font-size: 1.125em;
    }
    .data {
        flex-grow: 1;
        font-weight: 600;
        line-height: 1.685;
        font-size: 1.375em;
    }
    .prices {
        display: flex;
    }
    .discount {
        color: #C4C4C4;
    }
    .payment_method.red .discount {
        color: #FA655C;
    }
    .payment_method.green .discount {
        color: #5CBE72;
    }
    .tax {
        color: #C4C4C4;
        margin-left: 0.75em;
    }
    @media(max-width: 767px) {
        .payment_method {
            margin: 2.75em 0 0;
        }
        .logo {
            margin: 0;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -75%);
            background-color: #ffffff;
        }
        .data {
            font-size: 1em;
            line-height: 1;
        }
    }
</style>