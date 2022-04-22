<template>
    <label class="text_input_wrap">
        <textarea v-if="custom_type === 'textarea'" class="text_input" :placeholder="placeholder" :required="required" v-model="new_val" @change="$emit('change')" :maxlength="maxlength"></textarea>
        <input v-else :type="custom_type" class="text_input" :placeholder="placeholder" :required="required" v-model="new_val" @change="$emit('change')" :maxlength="maxlength" :min="min" :max="max">
    </label>
</template>

<script>

    export default {
        name: "textInput",
        props: {
            type: {
                type: String,
                default: 'text',
            },
            value: {
                type: String,
                default: '',
            },
            placeholder: {
                type: String,
                default: '',
            },
            required: {
                type: Boolean,
                default: false,
            },
            maxlength: {
            },
            disabled: {
                type: Boolean,
                default: false,
            },
            min: {
                default: '',
            },
            max: {
                default: '',
            },
        },
        data() {
            return {
                new_val: '',
                custom_type: 'text',
            };
        },
        mounted() {
            this.new_val = this.value;
            this.custom_type = this.type;
        },
        watch: {
            value(val) {
                this.new_val = val;
            },
            new_val(val) {
                this.$emit('input', val);
            },
        },
        methods: {
            phone_validate(data) {
                this.$emit('input', data.isValidByLibPhoneNumberJs ? data.number : '');
            },
        },
    }
</script>

<style scoped>
    .text_input_wrap {
        display: block;
        max-width: 100%;
    }
    .text_input {
        height: 3.125em;
        font-size: inherit;
        font-weight: 400;
        font-family: inherit;
        padding: 0 1.75em;
        box-sizing: border-box;
        margin: 0;
        border: 1px solid #CCCCCC;
        border-radius: 1.5625em;
        color: inherit;
        outline: none;
        display: block;
        width: 100%;
        background-color: #ffffff;
        line-height: 1.15;
        resize: none;
    }
    .text_input::placeholder {
        color: #808086;
    }
    .text_input:focus {
        border-color: #5CBE72;
    }
    textarea.text_input {
        height: 7em;
        padding: 1em 1.75em;
    }
    /*big*/
    .text_input_wrap.big .text_input {
        height: 4em;
        border-radius: 2em;
    }
    .text_input_wrap.error .text_input {
        border-color: #FA655C;
    }
</style>