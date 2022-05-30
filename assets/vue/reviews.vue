<template>
<div class="reviews">
    <div class="col col1">
        <div class="desc">
            <slot></slot>
        </div>
        <div class="items_wrap">
            <vue-scroll :ops="scrollbar">
                <review v-for="(review, indx) in reviews" v-bind="review" :key="indx"></review>
            </vue-scroll>
        </div>
    </div>
    <div class="col col2">
        <div class="review_form_wrap">
            <form class="review_form" @submit.prevent="submit">
                <div class="line1">Submit Your Review</div>
                <div class="line2">
                    <img class="star" v-for="n in 5" :src="'/img/icons/star-'+((n <= new_review.star) ? 'ff9100' : 'f9ecf8')+'.svg'" @click="new_review.star = n">
                </div>
                <div class="line3">
                    <text-input placeholder="Enter your name" required v-model="new_review.name"></text-input>
                    <text-input type="email" placeholder="Enter your email" v-model="new_review.email"></text-input>
                    <text-input type="textarea" placeholder="Enter your review" required v-model="new_review.text"></text-input>
                </div>
                <div class="line4">
                    <butt>Submit</butt>
                </div>
                <div class="error" v-if="error" v-html="error"></div>
            </form>
        </div>
    </div>
    <review-sent-popup v-if="success" @close="success = null"></review-sent-popup>
</div>
</template>

<script>

    import Review from "./review";
    import TextInput from "./textInput";
    import Butt from "./butt";
    import ReviewSentPopup from "./reviewSentPopup";
    import vuescroll from 'vuescroll';

    export default {
        name: "reviews",
        components: {
            ReviewSentPopup,
            Butt,
            TextInput,
            Review,
            'vue-scroll': vuescroll,
        },
        props: {
            service: {
                type: String,
                default: 'Site',
            },
        },
        data() {
            return {
                scrollbar: {
                    vuescroll: {
                        sizeStrategy: 'number',
                    },
                    scrollPanel: {
                        scrollingX: false,
                    },
                    rail: {
                        background: '#F1F1F1',
                        size: '0.25em',
                        specifyBorderRadius: '0.125em',
                    },
                    bar: {
                        background: '#5CBE72',
                        specifyBorderRadius: '0.125em',
                        size: '0.25em',
                        keepShow: true,
                    },
                },
                system: 'Instagram',
                new_review: {
                    name: '',
                    star: null,
                    text: '',
                    email: '',
                },
                reviews: [/*{
                    name: 'Vlad',
                    star: 5,
                    text: 'How did you make verified users with hundreds of thousands of followers to like my picture for such a cheap price? You should increase the prices on premium likes, seriously. I would be willing to pay way more for this service and keep the cheapskates out.”',
                },{
                    name: 'Margarita',
                    star: 5,
                    text: 'They are good and real.',
                },{
                    name: 'Make',
                    star: 5,
                    text: 'I use this service for 3 of my Instagram social media accounts and I have seen significant growth over the past few months. Will continue to use forever!!!',
                }*/],
                error: null,
                success: null,
            };
        },
        mounted() {
            var form_data = new FormData();
            form_data.append('system', this.system);
            form_data.append('service', this.service);
            axios.post('review_list.php', form_data).then((response) => {
                switch(response.data.result) {
                    case 'Ok': {
                        if(response.data.data) {
                            this.reviews = response.data.data;
                        }
                    } break;
                }
            });
        },
        methods: {
            submit() {
                if(this.new_review.star) {
                    var form_data = new FormData();
                    form_data.append('system', this.system);
                    form_data.append('service', this.service);
                    form_data.append('name', this.new_review.name);
                    form_data.append('star', this.new_review.star);
                    form_data.append('text', this.new_review.text);
                    axios.post('review_send.php', form_data).then((response) => {
                        switch (response.data.result) {
                            case 'Ok': {
                                this.new_review.name = '';
                                this.new_review.star = null;
                                this.new_review.text = '';
                                this.new_review.email = '';
                                this.success = true;
                            } break;
                            case 'Error': {
                                this.error = response.data.text;
                                this.success = false;
                            } break;
                        }
                    });
                } else {
                    this.error = 'Stars mark required!';
                }
            }
        },
        watch: {
            'new_review.name'() {
                this.error = '';
            },
            'new_review.star'() {
                this.error = '';
            },
            'new_review.text'() {
                this.error = '';
            },
            'new_review.email'() {
                this.error = '';
            },
        }
    }
</script>
<style scoped>
    .reviews {
        display: flex;
        margin: 0 -1em;
    }
    .col {
        padding: 0 1em;
        box-sizing: border-box;
        width: 50%;
    }
    .desc {
        font-weight: 600;
        line-height: 1.685;
        letter-spacing: -0.04em;
        margin: 0 0 1.75em;
    }
    .items_wrap {
        max-height: 28.125em;
    }
    .review_form_wrap {
        z-index: 1;
        position: relative;
        margin: 0 auto;
        max-width: 22.5em;
    }
    .review_form_wrap:before {
        content: '';
        display: block;
        position: absolute;
        z-index: -1;
        width: 44.75em;
        height: 44.75em;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url(/img/reviews_sect/form-bg.svg);
        top: 50%;
        left: 90%;
        transform: translate(-50%, -50%);
    }
    .review_form_wrap:after {
        content: '';
        display: block;
        position: absolute;
        width: 10em;
        height: 24.5em;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url(/img/reviews_sect/form-men.svg);
        z-index: 1;
        top: 67%;
        left: 114%;
        transform: translate(-50%, -50%);
    }
    .review_form {
        padding: 2.25em 2em;
        background-color: #ffffff;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        text-align: center;
        border-radius: 1.25em;

    }
    .review_form .line1 {
        font-weight: 600;
        font-size: 1.5em;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0 auto 1em;
    }
    .review_form .line2 {
        margin: -0.25em -0.25em 1.75em;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .review_form .line2 .star {
        max-width: 2.5em;
        max-height: 2.5em;
        margin: 0.25em;
        cursor: pointer;
    }
    .review_form .text_input_wrap {
        margin: 0 0 1.25em;
    }
    .review_form .butt {
        width: 12.5em;
    }
    .error {
        margin: 0.5em 0 0;
        font-size: 0.75em;
        color: red;
    }
    @media(max-width: 1199px) {
        .reviews {
            display: block;
            margin: 0;
        }
        .col {
            width: 100%;
            padding: 0;
        }
        .desc {
            margin: 0 auto 1em;
        }
        .items_wrap {
            margin: 0 auto 2.25em;
        }
        .review_form_wrap {
            margin: 0;
        }
    }
    @media(max-width: 767px) {
        .desc {
            margin: 0 0 0.625em;
        }
        .items_wrap {
            margin: 0 0 1.75em;
        }
        .review_form_wrap:after {
            display: none;
        }
        .review_form {
            padding: 1.25em 1.25em 1.5em;
        }
    }
</style>