<template>
    <section class="pricing" :class="inited ? 'inited' : ''">
        <div class="wrap">
            <slick-slider v-bind="slick" v-if="plans.length" class="row1" @init="slider_init">
                <plan  v-for="(plan, plan_indx) in plans" v-if="+plan.price" :key="plan_indx" v-bind="plan" @select="order_plan = plan" :service="service" :mark="mark" :reviews_qty="reviews_qty"></plan>
            </slick-slider>
        </div>
        <!--<order-popup v-if="order_plan" :plan="order_plan" @close="order_plan = null" :service="service" :system="system"></order-popup>-->
    </section>
</template>

<script>
    import orderPopup from "./orderPopup";
    import VueSlickCarousel from 'vue-slick-carousel';
    import 'vue-slick-carousel/dist/vue-slick-carousel.css';
    import plan from './plan';
    export default {
        name: "pricing",
        components: {
            'order-popup': orderPopup,
            'slick-slider': VueSlickCarousel,
            plan,
        },
        props: {
            limit: {
                type: Number,
                default: null,
            },
            service: {
                type: String,
                required: true,
            },
            system: {
                type: String,
                default: 'Instagram',
            },
        },
        data() {
            return {
                plans: [],
                selected_type: null,
                order_plan: null,
                touchThreshold: 10,
                slick: {
                    dots: false,
                    arrows: true,
                    slidesToShow: 4,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                                dots: true,
                                arrows: false,
                            }
                        },
                    ]
                },
                mark: null,
                reviews_qty: 0,
                inited: false,
            };
        },
        mounted() {
            axios.post('get_plans.php').then((response) => {
                if(response.data.result === 'Ok') {
                    this.plans = response.data.data[this.system][this.service].plans;
                    //this.order_plan = this.plans[1];
                }
            });
            //get mark
            var form_data = new FormData();
            form_data.append('system', this.system);
            form_data.append('service', this.service);
            axios.post('review_list.php', form_data).then((response) => {
                switch(response.data.result) {
                    case 'Ok': {
                        if(response.data.data) {
                            var marks_sum = 0;
                            response.data.data.forEach((review) => {
                                marks_sum += (+review.star);
                            });
                            this.mark = Math.ceil(marks_sum/response.data.data.length);
                            this.reviews_qty = response.data.data.length;
                        }
                    } break;
                }
            });
        },
        methods: {
            slider_init() {
                setTimeout(() => {
                    this.inited = true;
                }, 500);
            },
        },
        watch: {
            order_plan(plan) {
                if(plan) {
                    console.log(plan);
                    var params = {
                        'plan[count]': plan.count,
                        'plan[price]': plan.price,
                        service: this.service,
                        system: this.system,
                    };
                    for(var key in plan.extra) {
                        params['plan[extra]['+key+'][count]'] = plan.extra[key].count;
                        params['plan[extra]['+key+'][disabled]'] = plan.extra[key].disabled;
                        params['plan[extra]['+key+'][name]'] = plan.extra[key].name;
                        params['plan[extra]['+key+'][price]'] = plan.extra[key].price;
                    }
                    for(var key in plan.types) {
                        params['plan[types]['+key+'][disabled]'] = plan.types[key].disabled;
                        params['plan[types]['+key+'][discount]'] = plan.types[key].discount;
                        params['plan[types]['+key+'][name]'] = plan.types[key].name;
                        params['plan[types]['+key+'][price]'] = plan.types[key].price;
                    }

                    params = new URLSearchParams(params);
                    location.href = '/order/?'+params.toString();
                }
            }
        },
    }
</script>

<style scoped>
    .pricing {
        padding: 8.125em 0 5.625em;
    }
    .row1 {
        margin: 0 -0.75em;
    }
    @media(max-width: 1199px) {
        .pricing {
            padding: 5.75em 0 3em;
        }
        .row1 {
            margin: 0 calc(50% - 50vw - 3.75em);
        }
    }
    @media(max-width: 767px) {
        .pricing {
            padding: 4.75em 0 3.5em;
        }
        .row1 {
            margin: 0 calc(50% - 26.25em);
        }
    }
</style>
<style>
    /*
    .pricing.inited .slick-list {
        margin: 0 calc(50% - 50vw) -2em;
        padding: 0 calc(50vw - 50%) 2em;
    }*/
    .pricing .slick-list {
        margin: 0 0 -2em;
        padding: 0 0 2em;
    }/*
    .pricing .slick-slide {
        transition-property: opacity, visibility;
        transition-duration: 0.3s;
    }
    .pricing .slick-slide:not(.slick-active) {
        opacity: 0;
        visibility: hidden;
    }*/
</style>