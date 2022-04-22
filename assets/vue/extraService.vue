<template>
    <div class="extra_service" :class="{
        selected: selected,
    }" @click="click">
        <div class="indicator"></div>
        <div class="data">
            <div class="name">+ {{ count }} {{ name }}</div>
            <div class="price">+ {{ $root.user_info.sym_b }}{{ price }}{{ $root.user_info.sym_a }}</div>
        </div>
        <div class="info">
            <div class="info_text_wrap"><div class="info_text">Instant delivery guaranteed</div></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "extraService",
        props: {
            name: {},
            count: {},
            price: {},
            value: {},
            extra_key: {},
        },
        methods: {
            click() {
                var new_val = [];
                if(this.selected) {
                    this.value.forEach((extra_key) => {
                        if(extra_key !== this.extra_key) {
                            new_val.push(extra_key);
                        }
                    });
                } else {
                    this.value.forEach((extra_key) => {
                        new_val.push(extra_key);
                    });
                    new_val.push(this.extra_key);
                }
                this.$emit('input', new_val);
            },
        },
        computed: {
            selected() {
                return this.value.includes(this.extra_key);
            },
        },
    }
</script>

<style scoped>
    .extra_service {
        display: flex;
        height: 6.25em;
        box-sizing: border-box;
        border-radius: 2em;
        border: 1px solid #CCCCCC;
        padding: 0 1em;
        align-items: center;
        cursor: pointer;
        line-height: 1.685;
        transition-property: border-color, color;
        transition-duration: 0.3s;
    }
    .extra_service:hover,
    .extra_service.selected {
        border: 1px solid #5CBE72;
    }
    .extra_service:not(:last-child) {
        margin-bottom: 1em;
    }
    .indicator {
        width: 1.5em;
        height: 1.5em;
        box-sizing: border-box;
        margin-right: 2em;
        border-radius: 50%;
        border: 1px solid #C4C4C4;
        transition-property: border-color, background-color;
        transition-duration: 0.3s;
    }
    .extra_service.selected .indicator {
        border-color: #5CBE72;
        background-color: #5CBE72;
    }
    .data {
        flex-grow: 1;
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 1.375em;
    }
    .name {
        width: 60%;
    }
    .price {
        width: 40%;
        color: #5CBE72;
    }
    .info {
        margin-left: 1em;
        position: relative;
        width: 1.5em;
        height: 1.5em;
        background-image: url(/img/icons/info-c4c4c4.svg);
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
    }
    .info_text_wrap {
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        position: absolute;
        width: 15.5em;
        box-sizing: border-box;
        padding: 0.75em;
        color: #808086;
        text-align: center;
        background-color: #ffffff;
        border-radius: 0.625em;
        z-index: 1;
        bottom: calc(100% + 0.5em);
        left: 50%;
        transform: translate(-50%, 0);
        visibility: hidden;
        opacity: 0;
        transition-property: visibility, opacity;
        transition-duration: 0.3s;
    }
    .info:hover .info_text_wrap {
        opacity: 1;
        visibility: visible;
    }
    .info_text {
        font-size: 0.875em;
    }
    @media(max-width: 767px) {
        .extra_service:not(:last-child) {
            margin-bottom: 0.5em;
        }
        .indicator {
            margin-right: 0.5em;
        }
        .info {
            margin-left: 0.5em;
        }
        .data {
            width: calc(100% - 4em);
            font-size: 1em;
            line-height: 1;
        }
    }
</style>