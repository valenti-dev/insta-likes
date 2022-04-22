<template>
    <div class="process_items" >
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
        name: "processItems",
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

<style scoped>

</style>