<template>
    <div class="sections_items">
        <slick-slider v-bind="slick" v-if="window_width < 1200">
            <slot></slot>
        </slick-slider>
        <slot v-else></slot>
    </div>
</template>

<script>
    import VueSlickCarousel from 'vue-slick-carousel';
    import 'vue-slick-carousel/dist/vue-slick-carousel.css';
    export default {
        name: "sectionsItems",
        components: {
            'slick-slider': VueSlickCarousel,
        },
        data() {
            return {
                slick: {
                    dots: true,
                    arrows: false,
                    slidesToShow: 2,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ]
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
    .sections_items {
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .sections_items .item {
        padding: 2.75em 2em 2.25em;
        box-sizing: border-box;
        width: calc(100%/3);
        border-radius: 1.25em;
        border-bottom: 0.25em solid transparent;
        transition-property: box-shadow, background-color, border-bottom-color;
        transition-duration: 0.3s;
        text-decoration: none;
        color: inherit;
    }
    .sections_items .item:hover {
        background-color: #ffffff;
        border-bottom-color: #5CBE72;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
    }
    .sections_items .item .img_wrap {
        position: relative;
        margin: 0 auto 1em;
    }
    .sections_items .item .img_wrap:before {
        content: '';
        display: block;
        padding: 35% 0;
    }
    .sections_items .item .img_wrap .img {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
    }
    .sections_items .item .text_wrap {
        text-align: center;
    }
    .sections_items .item .title {
        font-size: 1.875em;
        font-weight: 600;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0 0 0.5em;
        transition-property: color;
        transition-duration: 0.3s;
    }
    .sections_items .item:hover .title {
        color: #5CBE72;
    }
    .sections_items .item .desc {
        color: #808086;
        letter-spacing: -0.04em;
        line-height: 1.685;
    }
    .sections_items .item .text_wrap:after {
        content: '';
        display: flex;
        width: 2.5em;
        height: 2.5em;
        margin: 0.75em auto 0;
        border-radius: 50%;
        box-sizing: border-box;
        align-items: center;
        justify-content: center;
        border: 0.1875em solid #5CBE72;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url(/img/icons/chevron-right-5cbe72.svg);
        background-size: 40% auto;
        transition-property: background-image, background-color;
        transition-duration: 0.3s;
    }
    .sections_items .item:hover .text_wrap:after {
        background-image: url(/img/icons/chevron-right-fff.svg);
        background-color: #5CBE72;
    }
    @media(max-width: 1199px) {
        .sections_items {
            display: block;
        }
        .sections_items .item {
            width: 100%;
            padding: 0;
            border-bottom: none;
        }
        .sections_items .item:hover {
            box-shadow: none;
            background-color: transparent;
        }
        .sections_items .item:hover .title {
            color: inherit;
        }
    }
    @media(max-width: 767px) {
        .sections_items .item .img_wrap {
            max-width: 12em;
        }
        .sections_items .item .title {
            font-size: 1.5em;
            margin: 0;
        }
    }
</style>