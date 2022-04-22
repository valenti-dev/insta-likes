<template>
    <div class="banner_items">
        <slick-slider v-bind="slick" v-if="window_width < 768">
            <slot></slot>
        </slick-slider>
        <slot v-else></slot>
    </div>
</template>

<script>
    import VueSlickCarousel from 'vue-slick-carousel';
    import 'vue-slick-carousel/dist/vue-slick-carousel.css';
    export default {
        name: "bannerItems",
        components: {
            'slick-slider': VueSlickCarousel,
        },
        data() {
            return {
                slick: {
                    dots: true,
                    arrows: false,
                    slidesToShow: 1,
                },
                window_width: window.outerWidth,
            };
        },
        mounted() {
            window.addEventListener('resize', () => {
                this.window_width = window.outerWidth;
            });
        }
    }
</script>

<style>
    .banner_items {
        margin: -1.5em;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .banner_items .item {
        padding: 2.75em 3.25em 2em;
        margin: 1.5em;
        box-sizing: border-box;
        width: calc(100%/3 - 3em);
        border-radius: 1.25em;
        border-bottom: 0.25em solid transparent;
        transition-property: box-shadow, background-color, border-bottom-color;
        transition-duration: 0.3s;
    }
    .banner_items .item:hover {
        background-color: #ffffff;
        border-bottom-color: #5CBE72;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
    }
    .banner_items .item .img_wrap {
        position: relative;
        margin: 0 auto 1em;
    }
    .banner_items .item .img_wrap:before {
        content: '';
        display: block;
        padding: 35% 0;
    }
    .banner_items .item .img_wrap .img {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
    }
    .banner_items .item .text_wrap {
        text-align: center;
    }
    .banner_items .item .title {
        font-size: 1.875em;
        font-weight: 600;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0 0 0.5em;
        transition-property: color;
        transition-duration: 0.3s;
    }
    .banner_items .item:hover .title {
        color: #5CBE72;
    }
    .banner_items .item .desc {
        color: #808086;
        letter-spacing: -0.04em;
        line-height: 1.685;
    }
    @media(max-width: 1199px) {
        .banner_items {
            margin: 0;
        }
        .banner_items .item {
            width: 50%;
            margin: 0;
            padding: 0.75em 1.625em;
            flex-grow: 1;
            max-width: 27.875em;
        }
        .banner_items .item .img_wrap {
            max-width: 14.375em;
        }
    }
    @media(max-width: 767px) {
        .banner_items {
            display: block;
        }
        .banner_items .item {
            width: 100%;
            padding: 0;
            border-bottom: none;
        }
        .banner_items .item:hover {
            box-shadow: none;
            background-color: transparent;
        }
        .banner_items .item .img_wrap {
            max-width: 12em;
        }
        .banner_items .item .title {
            font-size: 1.5em;
            margin: 0;
        }
        .banner_items .item:hover .title {
            color: inherit;
        }
    }
</style>