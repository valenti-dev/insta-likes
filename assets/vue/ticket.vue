<template>
    <section class="ticket_sect">
        <div class="wrap">
            <template v-if="start_loaded">
                <div class="row1">
                    <vue-scroll :ops="scrollbar" ref="msgs_scroll">
                        <div class="msgs_wrap">
                            <div v-for="msg in msgs" class="msg" :class="{admin: msg.is_admin}">
                                <div class="msg_text_wrap" v-if="msg.text">
                                    <div class="msg_text" v-html="msg.text"></div>
                                    <img alt="" :src="'/img/ticket_sect/'+(msg.is_admin ? 'admin-' : '')+'msg-part.svg'" class="msg_part">
                                </div>
                                <div class="msg_image_wrap" v-if="msg.img">
                                    <img alt="" class="msg_image" :src="msg.img">
                                </div>
                            </div>
                        </div>
                    </vue-scroll>
                </div>
                <form class="row2" @submit="send_msg">
                    <text-input v-model="new_msg_text" placeholder="Your message" required></text-input>
                    <butt>Send</butt>
                </form>
            </template>
            <div class="error" v-if="error" v-html="error"></div>
        </div>
    </section>
</template>

<script>
import TextInput from "./textInput";
import butt from "./butt";
import vuescroll from 'vuescroll';
export default {
    name: "ticket",
    components: {
        TextInput,
        butt,
        'vue-scroll':vuescroll,
    },
    props: {
        email: {
            type: String,
            default: true,
        },
        code: {
            type: String,
            default: true,
        },
    },
    data() {
        return {
            ticket: {},
            msgs: [],
            new_msg_text: null,
            load_limit: 100,
            load_timeout: 10000,
            load_timeout_key: null,
            scrollbar: {
                vuescroll: {
                },
                scrollPanel: {
                    scrollingX: false,
                },
                rail: {
                    background: 'rgba(0, 0, 0, 0.09)',
                    size: '0.5em',
                    specifyBorderRadius: '0.25em',
                    gutterOfSide: '0',
                },
                bar: {
                    background: 'rgba(0, 0, 0, 0.28)',
                    specifyBorderRadius: '0.125em',
                    size: '0.25em',
                    keepShow: true,
                },
            },
            start_loaded: false,
            error: null,
        };
    },
    mounted() {
        var form_data = new FormData();
        form_data.append('email', this.email);
        form_data.append('code', this.code);
        axios.post('ticket_info.php', form_data).then((response) => {
            switch(response.data.result) {
                case 'Ok': {
                    this.ticket = response.data.data;
                    document.title = this.ticket.title;
                    this.load_msgs();
                } break;
                case 'Error': {
                    this.error = response.data.text;
                } break;
            }
        });
    },
    methods: {
        load_msgs(callback) {
            var form_data = new FormData();
            form_data.append('email', this.email);
            form_data.append('code', this.code);
            form_data.append('start', this.msgs.length ? this.msgs[this.msgs.length - 1]['id'] : 0);
            form_data.append('limit', this.load_limit);
            axios.post('ticket_messages.php', form_data).then((response) => {
                switch(response.data.result) {
                    case 'Ok': {
                        var loaded_qty = 0;
                        if(response.data.data.list) {
                            for(var key in response.data.data.list) {
                                this.msgs.push(response.data.data.list[key]);
                                loaded_qty++;
                            }
                        }
                        if(loaded_qty >= this.load_limit) {
                            this.load_msgs();
                        } else {
                            if(!this.start_loaded) {
                                this.start_loaded = true;
                                setTimeout(() => {
                                    this.$refs['msgs_scroll'].scrollTo(
                                        {
                                            y: '100%'
                                        },
                                        300);
                                }, 500);
                            }
                            this.load_timeout_key = setTimeout(() => {
                                this.load_msgs();
                            }, this.load_timeout);
                        }
                    } break;
                }
                if(typeof callback === 'function') {
                    callback();
                }
            });
        },
        send_msg(event) {
            event.preventDefault();
            var form_data = new FormData();
            form_data.append('email', this.email);
            form_data.append('text', this.new_msg_text);
            axios.post('ticket_send.php', form_data).then((response) => {
                switch(response.data.result) {
                    case 'Ok': {
                        this.new_msg_text = null;
                        if(this.load_timeout_key) {
                            clearTimeout(this.load_timeout_key);
                            this.load_timeout_key = null;
                        }
                        this.load_msgs(() => {
                            setTimeout(() => {
                                this.$refs['msgs_scroll'].scrollTo(
                                    {
                                        y: '100%'
                                    },
                                    300);
                            }, 10);
                        });
                    } break;
                }
            });
        },
    },
}
</script>

<style scoped>
.ticket_sect {
    margin: -9em 0 0;
    padding: 12.5em 0 3.5em;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    background-image: url(/img/ticket_sect/bg.png);
    background-position: center;
    background-size: cover;
}
.wrap {
    display: flex;
    flex-grow: 1;
    flex-direction: column;
}
.row1 {
    flex-grow: 1;
    margin: 0 0 3.75em;
    height: 40em;
}
.row2 {
    display: flex;
}
.row2 .text_input_wrap {
    flex-grow: 1;
}
.row2 .butt {
    padding: 0 1.75em;
    min-width: 8.25em;
    margin-left: 0.75em;
    height: 3.125em;
}
.msgs_wrap {
    display: flex;
    flex-direction: column;
    padding: 0 2.25em 0 0.5em;
    box-sizing: border-box;
}
.msg {
    max-width: 100%;
    margin: 0 0 1.25em auto;
    box-sizing: border-box;
    filter: drop-shadow(0 0.25em 0.75em rgba(30, 35, 66, 0.11));
}
.msg:last-child {
    margin-bottom: 0;
}
.msg.admin {
    margin: 0 auto 1.25em 0;
}
.msg_text_wrap {
    box-sizing: border-box;
    background-color: #81BD75;
    color: #ffffff;
    padding: 0.75em 1.75em;
    border-radius: 1.75em;
    position: relative;
    z-index: 1;
    max-width: 100%;
}
.msg.admin .msg_text_wrap {
    background-color: #ffffff;
    color: #292E43;
}
.msg_part {
    position: absolute;
    bottom: 0;
    right: -0.5em;
    width: 1.5em;
    display: block;
    z-index: -1;
}
.msg.admin .msg_part {
    left: -0.5em;
    right: auto;
}
.msg_text {
    line-height: 1.465;
    font-size: 0.875em;
    overflow: hidden;
    text-overflow: ellipsis;
}
.msg_image_wrap {
    width: 32em;
    max-width: 100%;
}
.msg_image_wrap:not(:first-child) {
    margin-top: 1.25em;
}
.msg_image {
    display: block;
    max-width: 100%;
    border-radius: 1.75em;
}
.error {
    color: red;
    text-align: center;
    font-size: 1.5em;
    font-weight: 700;
}
.error:not(:first-child) {
    margin-top: 0.25em;
    font-size: 0.75em;
    font-weight: 400;
    text-align: left;
}
@media(max-width: 1199px) {
    .ticket_sect {
        margin: -7.5em 0 0;
        padding: 11em 0 3.5em;
    }
}
@media(max-width: 767px) {
    .ticket_sect {
        margin: -5.25em 0 0;
        padding: 6.75em 0 4em;
    }
    .row1 {
        margin-bottom: 2em;
        height: 30em;
    }
    .msgs_wrap {
        padding: 0 1em 0 0.5em;
    }
    .row2 {
        position: relative;
    }
    .row2 .butt {
        position: absolute;
        color: transparent;
        overflow: hidden;
        background-color: transparent;
        border-radius: 0;
        width: 3.125em;
        padding: 0;
        background-image: url(/img/ticket_sect/submit-icon.svg);
        background-size: 1.5em auto;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        right: 0;
        border: none;
        min-width: 0;
    }
    .row2 .butt:hover,
    .row2 .butt:active {
        color: transparent;
        border: none;
        background-color: transparent;
    }
}
</style>