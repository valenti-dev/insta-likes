<template>
    <form class="support_form" @submit.prevent="submit">
        <div class="fields_wrap">
            <field label="Username:">
                <text-input v-model="username" placeholder="Your Instagram Username"></text-input>
            </field>
            <field label="E-mail Address:">
                <text-input type="email" v-model="email" placeholder="Your E-mail Address" required></text-input>
            </field>
            <field label="Your Question:">
                <text-input type="textarea" v-model="question" placeholder="Text" required></text-input>
            </field>
        </div>
        <div class="accept_row">
            <checkbox v-model="news_accept"></checkbox>
            <span class="accept_text">I accept to receive news and promotion e-mails.</span>
        </div>
        <butt class="go_butt">Send A Message</butt>
        <msg-status-popup v-if="success !== null" :success="success" :error="error" @close="reset"></msg-status-popup>
    </form>
</template>

<script>
    import Field from "./field";
    import TextInput from "./textInput";
    import Butt from "./butt";
    import Checkbox from "./checkbox";
    import MsgStatusPopup from "./msgStatusPopup";
    export default {
        name: "supportForm",
        components: {MsgStatusPopup, Checkbox, Butt, TextInput, Field},
        data() {
            return {
                username: '',
                email: '',
                question: '',
                news_accept: true,
                success: null,
                error: '',
            };
        },
        methods: {
            submit() {
                var form_data = new FormData();
                form_data.append('email', this.email);
                form_data.append('text', this.username+"\n\n"+this.question);
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
            },
            reset() {
                this.email = '';
                this.username = '';
                this.question = '';
                this.success = null;
                this.error = null;
            },
        },
    }
</script>

<style scoped>
    .fields_wrap {
        display: flex;
        flex-wrap: wrap;
        margin: -0.5em -1em 1.5em;
    }
    .fields_wrap .field {
        margin: 0.5em 1em;
        width: calc(50% - 2em);
        flex-grow: 1;
    }
    .accept_row {
        margin: 0 0 1.75em;
        line-height: 1.465;
        display: flex;
        align-items: center;
    }
    .accept_row .checkbox {
        margin-right: 0.5em;
    }
    .accept_row .accept_text {
        font-size: 0.875em;
    }
    .butt.go_butt {
        min-width: 16em;
        box-shadow: none;
    }
    @media(max-width: 767px) {
        .fields_wrap {
            display: block;
            margin: 0 0 1.75em;
        }
        .fields_wrap .field {
            margin: 0 0 1em;
            width: 100%;
        }
        .fields_wrap .field:last-child {
            margin: 0;
        }
        .accept_row {
            margin: 0 0 1.25em;
            align-items: flex-start;
        }
        .accept_text {
            font-size: 1em;
            max-width: 15em;
        }
        .butt.go_butt {
            width: 100%;
        }
    }
</style>
<style>
    .support_form textarea.text_input {
        height: 4.625em;
    }
</style>