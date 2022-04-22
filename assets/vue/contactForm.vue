<template>
    <div class="contact_form_wrap">
        <form class="contact_form" @submit.prevent="submit">
            <div class="fields_wrap">
                <text-input class="field" v-model="form.name" placeholder="Enter your name"></text-input>
                <text-input type="email" class="field" required v-model="form.email" placeholder="Enter your email"></text-input>
                <v-select class="field" v-model="form.subject" placeholder="Enter your subject" :options="subjects"></v-select>
                <text-input class="field" v-model="form.order_id" placeholder="Order ID"></text-input>
                <text-input type="textarea" class="field" v-model="form.message" placeholder="Enter your message"></text-input>
            </div>
            <div class="actions_wrap">
                <vue-recaptcha
                        :sitekey="$root.recaptcha.site_key"
                        @verify="recaptcha_verify"
                        @expired="expired_verify"
                        class="captcha"
                ></vue-recaptcha>
                <butt>Send message</butt>
            </div>
            <div class="error" v-if="error" v-html="error"></div>
        </form>
        <msg-status-popup v-if="success" @close="success = null"></msg-status-popup>
    </div>
</template>

<script>
    import textInput from "./textInput";
    import butt from "./butt";
    import msgStatusPopup from "./msgStatusPopup";
    import { VueRecaptcha } from 'vue-recaptcha';
    import vSelect from 'vue-select'
    //import 'vue-select/dist/vue-select.css';
    import '../css/v-select.css';


    export default {
        name: "contactForm",
        components: {
            'msg-status-popup': msgStatusPopup,
            butt,
            'text-input': textInput,
            'vue-recaptcha': VueRecaptcha,
            'v-select': vSelect,
        },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    subject: '',
                    order_id: '',
                    message: '',
                },
                captcha_verified: false,
                success: null,
                error: '',
                subjects: [
                    'Instagram Likes',
                    'Instagram Followers',
                    'Instagram Views',
                    'Instagram Comments',
                ],
            };
        },
        methods: {
            submit() {
                if(this.captcha_verified) {
                    var form_data = new FormData();
                    form_data.append('email', this.form.email);
                    var text = this.form.message;
                    if(this.form.subject) {
                        text = 'Subject: '+this.form.subject+"\n"+text;
                    }
                    if(this.form.name) {
                        text = 'Name: '+this.form.name+"\n"+text;
                    }
                    form_data.append('text', text);
                    axios.post('ticket_send.php', form_data).then((response) => {
                        switch(response.data.result) {
                            case 'Error': {
                                this.error = response.data.text;
                                this.success = false;
                            } break;
                            case 'Ok': {
                                this.success = true;
                            } break;
                        }
                    });
                } else {
                    this.error = 'Please, check captcha!'
                }
            },
            reset() {
                this.email = '';
                this.message = '';
                this.success = null;
                this.error = null;
            },
            recaptcha_verify() {
                this.captcha_verified = true;
                this.error = '';
            },
            expired_verify() {
                this.captcha_verified = false;
            },
        },
    }
</script>

<style scoped>
    .contact_form {
        background-color: #ffffff;
        box-shadow: 0 1.125em 2em 0.25em rgba(0, 0, 0, 0.13);
        border-radius: 1.25em;
        box-sizing: border-box;
        padding: 1.5em;
    }
    .fields_wrap {
        display: flex;
        flex-wrap: wrap;
        margin: -1em -0.5em 0.5em;
    }
    .field {
        margin: 1em 0.5em;
        width: calc(25% - 1em);
    }
    .field:nth-child(5) {
        width: calc(100% - 1em);
    }
    .actions_wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .error {
        font-size: 0.75em;
        color: red;
        margin-top: 0.5em;
    }
    @media(max-width: 1199px) {
        .contact_form {
            max-width: 34.625em;
            margin: 0 auto;
            padding: 2.5em 2.25em;
        }
        .fields_wrap {
            margin: 0;
            display: block;
        }
        .field:nth-child(n) {
            margin: 0 0 1.75em;
            width: 100%;
        }
        .actions_wrap {
            flex-direction: column;
            align-items: center;
        }
        .captcha {
            margin: 0 auto 1.25em;
        }
    }
    @media(max-width: 767px) {
        .contact_form {
            padding: 1.25em;
        }
        .field:nth-child(n) {
            margin: 0 0 1.25em;
        }
        .captcha {
            transform: scale(0.8157);
            transform-origin: left;
        }
    }
</style>
<style>
    .contact_form .text_input {
        height: 4em;
        border-radius: 2em;
    }
    .contact_form textarea.text_input {
        height: 8.75em;
        padding: 1.425em 1.75em;
    }
    @media(max-width: 767px) {
        .contact_form .text_input {
            height: 3.125em;
            border-radius: 1.5625em;
        }
        .contact_form textarea.text_input {
            height: 7em;
            padding: 1em 1.75em;
        }
    }
</style>