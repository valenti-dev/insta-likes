<template>
        <div class="order_form">
            <div class="title">
                <template v-if="step === 1">{{ (username_select && accounts.length) ? 'Choose' : 'Add' }} account</template>
                <template v-if="step === 2">
                    <template v-if="service === 'Auto-Likes'">
                        <div style="font-size: 0.75em;">{{ this.system }} {{ Math.floor(plan.count/(count_posts ? count_posts : 1)) }} <span style="white-space: nowrap;">{{ this.service }}</span> Per post</div>
                    </template>
                    <template v-else-if="service === 'Followers'">{{ this.system }} {{ plan.count }} {{ this.service }}</template>
                    <template v-else>Choose posts</template>
                </template>
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
                                    }" @click="to_step2"></account>
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

                <div class="butt_wrap" v-if="!username_select || !accounts.length">
                    <butt :disabled="disabled" :loading="loading" @click="to_step2">Next</butt>
                </div>

            </template>
            <template v-if="step === 2">
                <div class="posts_container" v-if="posts.length">
                    <div class="posts_wrap">
                        <vue-scroll :ops="scrollbar">
                            <div class="posts_list">
                                <post v-for="(post, post_indx) in posts" :key="post_indx" :post="post" v-model="selected_posts" :qty="selected_posts.length ? Math.floor(plan.count/selected_posts.length) : null" :service="service"></post>
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
                    <button class="type" v-for="(type, type_key) in plan_types" v-if="!(+type.disabled)" @click="selected_type = type_key" :class="{
                        selected: (type_key === selected_type),
                    }">
                        <span class="type_label">{{ type.name }}</span>
                    </button>
                </div>
                <div class="extra_services_wrap" v-if="plan.extra">
                    <extra-service v-for="(extra_service, extra_service_key) in plan.extra" :key="extra_service_key" v-bind="extra_service" v-model="selected_extra" :extra_key="extra_service_key"></extra-service>
                </div>
                <div class="butt_wrap" v-if="selected_type">
                    <butt :disabled="disabled" :loading="loading" @click="to_step3">Choose payment method for {{ $root.user_info.sym_b }}{{ cost }}{{ $root.user_info.sym_a }}</butt>
                </div>
            </template>
            <template v-if="step === 3">
                <div class="desc">Payment method</div>
                <div class="payment_methods_list">
                    <payment-method v-for="(payment_method, payment_method_indx) in payment_methods" v-bind="payment_method" :key="payment_method_indx"></payment-method>
                </div>
                <div class="rules_text">
                    By purchasing you agree with <a href="/terms" target="_blank">rules</a>
                </div>
            </template>
            <div class="back_link_wrap" v-if="step !== 1">
                <a href="#" @click.prevent="go_back"><img alt="" src="/img/icons/chevron-left-5cbe72.svg">Back</a>
            </div>
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
            init_plan: {
                type: Object,
            },
            init_system: {
                type: String,
            },
            init_service: {
                type: String,
            },
            init_step: {
                default: null,
            },
            init_order: {
                default: null,
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
                ls_keys: {
                    email: 'email',
                    accounts: 'accounts',
                },
                plan: {},
                system: null,
                service: null,
                email: '',
                username: '',
                username_select: false,
                accounts: [],
                disabled: false,
                loading: null,
                loading_interval: null,
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
                order_num: null,
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
            if(this.init_step) {
                this.step = +this.init_step;
            }
            if(this.init_system) {
                this.system = this.init_system;
            }
            if(this.init_service) {
                this.service = this.init_service;
            }
            if(this.init_plan) {
                this.plan = this.init_plan;
            }
            if(this.init_order) {
                this.order_num = +this.init_order;
                this.load_order(this.order_num);
            }
            /*
            if(this.step === 2 && this.need_posts) {
                this.load_posts();
            }*/
            console.log(this.plan.types);
        },
        methods: {
            close() {
                this.$emit('close');
            },
            /**/
            to_step2() {
                if(this.email) {
                    this.save_email(this.email);
                    var order_num = 0;
                    do {
                        order_num++;
                    } while(localStorage.getItem('order_'+order_num));
                    var params = {order: order_num};
                    if (this.need_posts) {
                        this.load_posts(() => {
                            this.save_order(order_num);
                            params = new URLSearchParams(params);
                            location.href = '/order/step2?'+params.toString();
                        });
                    } else {
                        if (!this.username) {
                            this.errors.username = 'Username required!';
                        } else {
                            this.save_order(order_num);
                            params = new URLSearchParams(params);
                            location.href = '/order/step2?'+params.toString();
                        }
                    }
                } else {
                    this.errors.email = 'E-mail required!';
                }
            },
            load_posts(callback) {
                this.disabled = true;
                this.loading = 1;
                this.loading_interval = setInterval(() => {
                    if(this.loading < 85) {
                        this.loading += 15;
                    }
                }, 300);
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
                axios.post('get_posts_v2.php', form_data/*, {
                    onUploadProgress: (progressEvent) => {
                        this.loading = Math.ceil(progressEvent.loaded/progressEvent.total*100/2);
                    },
                    onDownloadProgress: (progressEvent) => {
                        if(progressEvent.total) {
                            this.loading = 50 + Math.ceil(progressEvent.loaded/progressEvent.total*100/2);
                        }
                    },
                }*/).then((response) => {
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
                    if(this.loading_interval) {
                        clearInterval(this.loading_interval);
                        this.loading_interval = null;
                    }
                    this.loading = 100;
                    setTimeout(() => {
                        this.loading = null;
                    }, 300);
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
                this.loading = 1;
                this.loading_interval = setInterval(() => {
                    if(this.loading < 98) {
                        this.loading += 2;
                    }
                }, 300);
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
                            if(response.data.text === 'Please, enter correct links.') {
                                this.errors.general = 'Please choose an Instagram post.';
                            } else {
                                this.errors.general = response.data.text;
                            }
                        } break;
                        case 'Ok': {
                            this.payment_methods = response.data.data.methods;
                            //this.step = 3;
                            this.save_order(this.order_num);
                            var params = {
                                order: this.order_num,
                            };
                            params = new URLSearchParams(params);
                            location.href = '/order/step3?'+params.toString();
                        } break;
                    }
                }).catch((response) => {}).then(() => {
                    this.disabled = false;
                    if(this.loading_interval) {
                        clearInterval(this.loading_interval);
                        this.loading_interval = null;
                    }
                    this.loading = 100;
                    setTimeout(() => {
                        this.loading = null;
                    }, 300);
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
            go_back() {
                history.back();
            },

            save_order(num) {
                var order_data = {
                    plan: this.plan,
                    service: this.service,
                    system: this.system,
                    email: this.email,
                    username: this.username,
                    posts: this.posts,
                    count_posts: this.count_posts,
                    payment_methods: this.payment_methods,
                    posts_user_id: this.posts_user_id,
                    selected_type: this.selected_type,
                    selected_posts: this.selected_posts,
                    selected_extra: this.selected_extra,
                };
                localStorage.setItem('order_'+num, JSON.stringify(order_data));
            },
            load_order(num) {
                var order_data = JSON.parse(localStorage.getItem('order_'+num));
                if(order_data) {
                    for(var key in order_data) {
                        this[key] = order_data[key];
                    }
                }
                return order_data;
            }
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
                            for(var key in this.plan_types) {
                                if(!(+this.plan_types[key].disabled)) {
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
                var cost = +this.plan.types[this.selected_type].price;
                this.selected_extra.forEach((extra_key) => {
                    cost += +this.plan.extra[extra_key].price;
                });
                return cost.toFixed(2);
            },
            need_posts() {
                return this.need_posts_services.includes(this.service);
            },
            plan_types() {
                var sort_arr = [];
                for(var key in this.plan.types) {
                    sort_arr.push({
                        key: key,
                        price: +this.plan.types[key].price,
                    })
                }
                sort_arr.sort(function(a, b) {
                    return a.price - b.price;
                });
                var result = {};
                sort_arr.forEach((item) => {
                    result[item.key] = this.plan.types[item.key];
                });
                return result;
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
        max-width: 100%;
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
    .back_link_wrap {
        text-align: center;
        font-size: 1.125em;
        margin: 1.5em 0 0;
        line-height: 1.15;
        font-weight: 600;
    }
    .back_link_wrap a {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    .back_link_wrap a img {
        max-height: 0.625em;
        margin-right: 0.5em;
    }
    @media(max-width: 767px) {
        .order_form {
            padding: 1.5em 1.25em;
            /**/
            margin: 2em calc(50% - 50vw);
            padding: 1.5em calc(50vw - 50%);
            max-width: none;
            width: 100vw;
            /**/
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
<style>
.order_form .__vuescroll .__view {
    padding-right: 0.75em;
}
</style>