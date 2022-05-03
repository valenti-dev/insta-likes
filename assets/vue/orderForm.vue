<template>
        <div class="order_form">
            <div class="title">
                <template v-if="step === 1">Choose account</template>
                <template v-if="step === 2">Choose posts</template>
                <template v-if="step === 3">{{ $root.user_info.sym_b }}{{ cost }}{{ $root.user_info.sym_a }}</template>
            </div>
            <div class="steps_wrap">
                <div class="step" :class="{active: (step >= 1)}">1</div>
                <div class="hr"></div>
                <div class="step" :class="{active: (step >= 2)}">2</div>
                <div class="hr"></div>
                <div class="step" :class="{active: (step >= 3)}">3</div>
            </div>
            <template v-if="step === 1">
                <div class="fields_wrap">
                    <field :error="errors.username">
                        <div v-if="username_select && accounts.length" class="accounts_wrap">
                            <vue-scroll :ops="scrollbar">
                                <div class="accounts_list">
                                    <account v-for="(account, account_indx) in accounts" v-bind="account" v-model="username" @remove="rm_account(account_indx)" :key="account_indx" :class="{
                                        error: errors.username,
                                    }"></account>
                                </div>
                            </vue-scroll>
                        </div>
                        <text-input v-else v-model="username" placeholder="Enter your username" required class="field big" :class="{
                            error: errors.username,
                        }"></text-input>
                    </field>
                    <field :error="errors.email">
                        <text-input type="email" v-model="email" placeholder="Enter your email" required class="field big" :class="{
                            error: errors.email,
                        }"></text-input>
                    </field>
                </div>
                <div class="link_wrap" v-if="username_select && accounts.length">
                    <a href="#" @click.prevent="username_select = false">Add new one</a>
                </div>
                <div class="butt_wrap">
                    <butt :disabled="disabled" @click="to_step2">Buy</butt>
                </div>
            </template>
            <template v-if="step === 2">
                <div class="posts_container" v-if="posts.length">
                    <div class="posts_wrap">
                        <vue-scroll :ops="scrollbar">
                            <div class="posts_list">
                                <post v-for="(post, post_indx) in posts" :key="post_indx" :post="post" v-model="selected_posts"></post>
                            </div>
                        </vue-scroll>
                    </div>
                    <div class="load_more_wrap" v-if="!all_posts_loaded">
                        <button class="load_more" @click="load_posts" :disabled="disabled"></button>
                    </div>
                </div>
                <div class="fields_wrap" v-if="service === 'Auto-Likes'">
                    <field :error="errors.count_posts">
                        <text-input type="number" v-model="count_posts" placeholder="Enter count of posts" required class="field big" min="1" max="99" :class="{
                            error: errors.count_posts,
                        }"></text-input>
                    </field>
                </div>
                <div class="types_wrap">
                    <button class="type" v-for="(type, type_key) in plan.types" v-if="!(+type.disabled)" @click="selected_type = type_key" :class="{
                        selected: (type_key === selected_type),
                    }">
                        <span class="type_label">{{ type.name }}</span>
                    </button>
                </div>
                <div class="extra_services_wrap" v-if="plan.extra">
                    <extra-service v-for="(extra_service, extra_service_key) in plan.extra" :key="extra_service_key" v-bind="extra_service" v-model="selected_extra" :extra_key="extra_service_key"></extra-service>
                </div>
                <div class="butt_wrap" v-if="selected_type">
                    <butt :disabled="disabled" @click="to_step3">Choose payment method for {{ $root.user_info.sym_b }}{{ cost }}{{ $root.user_info.sym_a }}</butt>
                </div>
            </template>
            <template v-if="step === 3">
                <div class="desc">Payment method</div>
                <div class="payment_methods_list">
                    <payment-method v-for="(payment_method, payment_method_indx) in payment_methods" v-bind="payment_method" :key="payment_method_indx"></payment-method>
                </div>
                <div class="rules_text">
                    By pershing you agree with <a href="/terms" target="_blank">rules</a>
                </div>
            </template>
            <div class="error" v-if="errors.general">{{ errors.general }}</div>
        </div>
</template>

<script>
    import TextInput from "./textInput";
    import Butt from "./butt";
    import vuescroll from 'vuescroll';
    import Popup from "./popup";
    import Account from "./account";
    import Field from "./field";
    import Post from "./post";
    import ExtraService from "./extraService";
    import PaymentMethod from "./paymentMethod";
    export default {
        name: "orderForm",
        components: {
            PaymentMethod,
            ExtraService,
            Post,
            Field,
            Account,
            Popup,
            Butt, TextInput,
            'vue-scroll':vuescroll,
        },
        props: {
            plan: {
                type: Object,
            },
            origin_plans: {
                type: Array,
            },
            system: {
                type: String,
                default: 'Instagram',
            },
            service: {
                type: String,
            },
            init_step: {
                default: null,
            },
            init_payment_methods: {
                type: Array,
            },
            init_email: {
                type: String,
            },
            init_username: {
                type: String,
            },
            init_cost: {},
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
                ls_keys: {
                    email: 'email',
                    accounts: 'accounts',
                },
                email: '',
                username: '',
                username_select: false,
                accounts: [],
                disabled: false,
                step: 1,
                errors: {
                    email: null,
                    username: null,
                    general: null,
                    count_posts: null,
                },
                need_posts_services: ['Likes', 'Views', 'Comments'],
                posts_user_id: null,
                posts: [],
                selected_type: null,
                selected_posts: [],
                all_posts_loaded: false,
                selected_extra: [],
                payment_methods: [],
                count_posts: null,
            };
        },
        mounted() {
            this.email = localStorage.getItem(this.ls_keys.email);
            var accounts = localStorage.getItem(this.ls_keys.accounts);
            if(accounts) {
                accounts = JSON.parse(accounts);
                if(accounts.length) {
                    this.accounts = accounts;
                    this.username_select = true;
                }
            }
            ///on time
            //this.username = 'vseznaemo_zt';
            //this.to_step2();
            if(this.init_step) {
                this.step = +this.init_step;
            }/*
            if(this.init_posts) {
                this.posts = this.init_posts;
            }*/
            if(this.init_payment_methods) {
                this.payment_methods = this.init_payment_methods;
            }
            if(this.init_email) {
                this.email = this.init_email;
            }
            if(this.init_username) {
                this.username = this.init_username;
            }
            if(this.step === 2 && this.need_posts) {
                console.log('load posts');
                this.load_posts();
            }
        },
        methods: {
            close() {
                this.$emit('close');
            },
            /**/
            to_step2() {
                if(this.email) {
                    var params = {
                        'plan[count]': this.plan.count,
                        'plan[price]': this.plan.price,
                        service: this.service,
                        system: this.system,
                        email: this.email,
                        username: this.username,
                    };
                    for(var key in this.plan.extra) {
                        params['plan[extra]['+key+'][count]'] = this.plan.extra[key].count;
                        params['plan[extra]['+key+'][disabled]'] = this.plan.extra[key].disabled;
                        params['plan[extra]['+key+'][name]'] = this.plan.extra[key].name;
                        params['plan[extra]['+key+'][price]'] = this.plan.extra[key].price;
                    }
                    for(var key in this.plan.types) {
                        params['plan[types]['+key+'][disabled]'] = this.plan.types[key].disabled;
                        params['plan[types]['+key+'][discount]'] = this.plan.types[key].discount;
                        params['plan[types]['+key+'][name]'] = this.plan.types[key].name;
                        params['plan[types]['+key+'][price]'] = this.plan.types[key].price;
                    }



                    if (this.need_posts) {
                        this.load_posts(() => {
                            //this.step = 2;
                            /*
                            this.posts.forEach((post, post_indx) => {
                                params['posts['+post_indx+'][link]'] = post.link;
                                params['posts['+post_indx+'][img]'] = post.img;
                                params['posts['+post_indx+'][type]'] = post.type;
                            });*/
                            params = new URLSearchParams(params);
                            location.href = '/order/step2?'+params.toString();
                        });
                    } else {
                        if (!this.username) {
                            this.errors.username = 'Username required!';
                        } else {
                            //this.step = 2;
                            params = new URLSearchParams(params);
                            location.href = '/order/step2?'+params.toString();
                        }
                    }
                    this.save_email(this.email);
                } else {
                    this.errors.email = 'E-mail required!';
                }
            },
            load_posts(callback) {
                this.disabled = true;
                var form_data = new FormData();
                form_data.append('system', this.system);
                form_data.append('service', this.service);
                form_data.append('count', this.plan.count);
                var username = this.username[0] === '@' ? this.username.substr(1) : this.username;
                form_data.append('username', username);
                if(this.posts_user_id) {
                    form_data.append('more', 1);
                    form_data.append('user_id', this.posts_user_id);
                    this.all_posts_loaded = true;
                }
                axios.post('get_posts_v2.php', form_data).then((response) => {
                    switch(response.data.result) {
                        case 'Error': {
                            switch(+response.data.error_code) {
                                case 101: { this.errors.general = response.data.text; } break;
                                case 102: { this.errors.email = response.data.text; } break;
                                case 103: { this.errors.general = response.data.text; } break;
                                case 104: { this.errors.general = response.data.text; } break;
                                case 201: { this.errors.username = response.data.text; } break;
                                case 202: { this.errors.username = response.data.text; } break;
                                case 203: { this.errors.username = response.data.text; } break;
                                case 301: { this.errors.general = response.data.text; } break;
                            }
                        } break;
                        case 'Ok': {
                            var account = {
                                username: username,
                                avatar: response.data.data.avatar,
                            };
                            if(response.data.data.user_id) {
                                this.posts_user_id = response.data.data.user_id;
                            }
                            this.posts = response.data.data.posts;
                            this.save_account(account);
                            if(typeof callback === 'function') {
                                callback();
                            }
                        } break;
                    }
                }).catch().then(() => {
                    this.disabled = false;
                });
            },
            to_step3() {
                var username = this.username[0] === '@' ? this.username.substr(1) : this.username;
                var form_data = new FormData();
                form_data.append('cart', 0);
                form_data.append('email', this.email);
                form_data.append('system', this.system);
                form_data.append('service', this.service);
                form_data.append('type', this.selected_type);
                form_data.append('count', this.plan.count);
                form_data.append('username', username);
                if(this.service === 'Auto-Likes') {
                    if(this.count_posts < 1 || this.count_posts > 99) {
                        this.errors.count_posts = 'Count of posts must be from 1 to 99!';
                        return ;
                    } else {
                        form_data.append('count_posts', this.count_posts);
                    }
                }
                this.disabled = true;


                if(this.need_posts) {
                    this.selected_posts.forEach((post) => {
                        form_data.append('url[]', post.link);
                        form_data.append('img[]', post.img);
                    });
                }
                if(this.selected_extra) {
                    this.selected_extra.forEach((extra_key) => {
                        form_data.append('extra['+extra_key+']', '1');
                    });
                }
                axios.post('create_order_v2.php', form_data).then((response) => {
                    switch(response.data.result) {
                        case 'Error': {
                            this.errors.general = response.data.text;
                        } break;
                        case 'Ok': {
                            this.payment_methods = response.data.data.methods;
                            //this.step = 3;
                            var params = {
                                'cost': this.cost,
                            };
                            for(var key in this.payment_methods) {
                                params['methods['+key+'][name]'] = this.payment_methods[key].name;
                                params['methods['+key+'][discount]'] = this.payment_methods[key].discount;
                                params['methods['+key+'][tax]'] = this.payment_methods[key].tax;
                                params['methods['+key+'][price_usd]'] = this.payment_methods[key].price_usd;
                                params['methods['+key+'][tax_usd]'] = this.payment_methods[key].tax_usd;
                                params['methods['+key+'][price_local]'] = this.payment_methods[key].price_local;
                                params['methods['+key+'][tax_local]'] = this.payment_methods[key].tax_local;
                                params['methods['+key+'][url_to_pay]'] = this.payment_methods[key].url_to_pay;
                                params['methods['+key+'][modal]'] = this.payment_methods[key].modal;
                            }
                            params = new URLSearchParams(params);
                            location.href = '/order/step3?'+params.toString();
                        } break;
                    }
                }).catch((response) => {}).then(() => {
                    this.disabled = false;
                });
            },
            //step1
            select_account() {

            },
            rm_account(indx) {
                if(this.accounts[indx]) {
                    var accs = this.accounts;
                    if(this.username === accs[indx].username) {
                        this.username = '';
                    }
                    accs.splice(indx, 1);
                    localStorage.setItem(this.ls_keys.accounts, JSON.stringify(accs));
                }
            },
            save_account(acc) {
                if(this.accounts.every((_acc) => { return _acc.username !== acc.username })) {
                    this.accounts.push(acc);
                    localStorage.setItem(this.ls_keys.accounts, JSON.stringify(this.accounts));
                }
            },
            save_email(email) {
                localStorage.setItem(this.ls_keys.email, email);
            },
        },
        watch: {
            username() {
                this.errors.username = null;
                this.errors.general = null;
            },
            email() {
                this.errors.email = null;
                this.errors.general = null;
            },
            count_posts() {
                this.errors.count_posts = null;
                this.errors.general = null;
            },
            step() {
                switch(+this.step) {
                    case 2: {
                        if(!this.selected_type) {
                            for(var key in this.plan.types) {
                                if(!(+this.plan.types[key].disabled)) {
                                    this.selected_type = key;
                                    break;
                                }
                            }
                        }
                        //this.to_step3();
                    } break;
                }
                this.errors.general = null;
            },
            selected_posts() {
                this.errors.general = null;
            },
        },
        computed: {
            cost() {
                if(this.step === 3) {
                    cost = +this.init_cost;
                } else {
                    var cost = +this.plan.types[this.selected_type].price;
                    this.selected_extra.forEach((extra_key) => {
                        cost += +this.plan.extra[extra_key].price;
                    });
                }
                return cost.toFixed(2);
            },
            need_posts() {
                return this.need_posts_services.includes(this.service);
            },
        },
    }
</script>

<style scoped>
    .order_form {
        padding: 2.5em 2.25em;
        box-sizing: border-box;
        background-color: #ffffff;
        border-radius: 1.25em;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        max-width: 90%;
        width: 35em;
        margin: 2.5em auto;
    }
    .title {
        text-align: center;
        font-weight: 900;
        font-size: 2.75em;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        line-height: 1.25;
        margin: 0 0 0.35em;
    }
    .fields_wrap {
        margin: 0 0 1em;
    }
    .link_wrap {
        text-align: center;
        font-weight: 600;
        letter-spacing: -0.02em;
        line-height: 1.15;
        font-size: 1.125em;
    }
    .steps_wrap {
        display: flex;
        margin: 0 0 1.25em;
        justify-content: center;
        align-items: center;
    }
    .step {
        width: 2.75em;
        height: 2.75em;
        box-sizing: border-box;
        border: 1px solid #5CBE72;
        display: flex;
        align-items: center;
        border-radius: 50%;
        color: #5CBE72;
        justify-content: center;
        text-align: center;
        font-weight: 600;
        transition-property: background-color, color;
        transition-duration: 0.3s;
    }
    .step.active {
        background-color: #5CBE72;
        color: #ffffff;
    }
    .steps_wrap .hr {
        margin: 0 0.25em;
        width: 0.625em;
        height: 1px;
        background-color: #C4C4C4;
    }
    .butt_wrap .butt {
        width: 100%;
    }
    .order_form > .error {
        font-size: 0.75em;
        margin: 0.5em 0 0;
        color: #FA655C;
        letter-spacing: -0.02em;
        line-height: 1.15;
        font-weight: 700;
    }
    .accounts_wrap {
        max-height: 13.125em;
    }
    .link_wrap:not(:last-child) {
        margin-bottom: 1em;
    }
    .posts_container {
        margin: 0 0 3em;
    }
    .posts_wrap {
        max-height: 22em;
    }
    .posts_list {
        display: flex;
        flex-wrap: wrap;
        margin: -0.625em;
    }
    .post {
        margin: 0.625em;
        width: calc(25% - 1.25em);
    }
    .load_more {
        margin: 1.5em auto 0;
        width: 6em;
        display: block;
        height: 2em;
        background-color: #ffffff;
        border-radius: 0.625em;
        border: none;
        font-size: inherit;
        padding: 0;
        cursor: pointer;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        background-position: center;
        background-size: 50% auto;
        background-repeat: no-repeat;
        background-image: url(/img/icons/more-5cbe72.svg);
        transition-property: box-shadow, opacity;
        transition-duration: 0.3s;
    }
    .load_more:active {
        box-shadow: none;
    }
    .load_more:disabled {
        opacity: 0.5;
        box-shadow: none;
    }
    .types_wrap {
        display: flex;
        margin: 0 0 1.25em;
    }
    .type {
        width: 100%;
        font-size: inherit;
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        background-color: transparent;
        color: inherit;
        border: 1px solid #CCCCCC;
        height: 4em;
        line-height: 1.685;
        font-weight: 600;
        position: relative;
        cursor: pointer;
        transition-property: background-color, color, border-color;
        transition-duration: 0.3s;
    }
    .type:not(:last-child) {
        margin-right: -1px;
    }
    .type:first-child {
        border-radius: 2em 0 0 2em;
    }
    .type:last-child {
        border-radius: 0 2em 2em 0;
    }
    .type:first-child:last-child {
        border-radius: 2em;
    }
    .type:hover {
        z-index: 1;
        border-color: #5CBE72;
        color: #5CBE72;
    }
    .type.selected {
        border-color: #5CBE72;
        color: #5CBE72;
        background-color: #F4F9F5;
        z-index: 1;
    }
    .extra_services_wrap {
        margin: 0 0 1.25em;
    }
    .desc {
        text-align: center;
        font-weight: 600;
        line-height: 1.685;
        font-size: 1.375em;
        margin: 0 0 1em;
    }
    .rules_text {
        margin: 0.75em 0 0;
        text-align: center;
        font-weight: 600;
        line-height: 1.685;
        font-size: 1.375em;
        color: #C4C4C4;
    }
    .rules_text a {
        color: inherit;
    }
    @media(max-width: 767px) {
        .order_form {
            padding: 1.5em 1.25em;
        }
        .title {
            font-size: 1.5em;
        }
        .desc {
            font-size: 1.375em;
        }
        .posts_list {
            margin: -0.25em;
        }
        .post {
            margin: 0.25em;
            width: calc(25% - 0.5em);
            height: 3.25em;
            border-radius: 0.25em;
        }
        .rules_text {
            font-size: 1em;
        }
    }
</style>