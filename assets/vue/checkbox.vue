<template>
    <button class="checkbox" @click.prevent="change" :class="[(disabled ? 'disabled' : ''), (checked ? 'checked' : '')]">
        <img src="/img/icons/check-292e43.svg" class="icon">
    </button>
</template>

<script>
    export default {
        name: "checkbox",
        data() {
            return {
                result: false,
            };
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            value: {
            },
            val: {
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        mounted() {
            this.result = this.value;
        },
        computed: {
            is_result_array() {
                return Array.isArray(this.result)
            },
            checked() {
                //console.log(this.val);
                if(typeof this.val === 'object' && this.is_result_array) {
                    return this.result.some((item) => {
                        if(typeof item === 'object') {
                            var accept = true;
                            for(var key in item) {
                                if(item[key] !== this.val[key]) {
                                    accept = false;
                                    break;
                                }
                            }
                            if(accept) {
                                for(var key in this.val) {
                                    if(this.val[key] !== item[key]) {
                                        accept = false;
                                        break;
                                    }
                                }
                            }
                            return accept;
                        }
                        return false;
                    });
                } else {
                    return this.is_result_array ? this.result.includes(this.val) : this.result;
                }
            },
        },
        methods: {
            change() {
                if(this.disabled) return ;
                if(this.is_result_array) {
                    if(this.checked) {
                        while (this.checked) {
                            var val_indx = null;
                            if(typeof this.val === 'object') {
                                this.result.forEach((item, item_indx) => {
                                    if(typeof item === 'object') {
                                        var accept = true;
                                        for(var key in item) {
                                            if(item[key] !== this.val[key]) {
                                                accept = false;
                                                break;
                                            }
                                        }
                                        if(accept) {
                                            for(var key in this.val) {
                                                if(this.val[key] !== item[key]) {
                                                    accept = false;
                                                    break;
                                                }
                                            }
                                        }
                                        if(accept) {
                                            val_indx = item_indx;
                                        }
                                    }
                                });
                            } else {
                                val_indx = this.result.indexOf(this.val);
                            }
                            if(val_indx !== null) {
                                this.result.splice(val_indx, 1);
                            } else {
                                break;
                            }
                        }
                    } else {
                        this.result.push(this.val);
                    }
                } else {
                    this.result = !this.checked;
                }
                this.$emit('input', this.result);
                this.$emit(this.checked ? 'select' : 'deselect');
            },
        },
        watch: {
            value(val) {
                if(this.is_result_array
                    && (!Array.isArray(val)
                        || this.result.length !== val.length
                        || !(this.result.every((item, indx) => { return item === val[indx];})))) {
                    this.result = val;
                } else if(this.result !== val) {
                    this.result = val;
                }
            },
        },
    }
</script>

<style scoped>
    .checkbox {
        position: relative;
        border-radius: 0.125em;
        overflow: hidden;
        z-index: 1;
        cursor: pointer;
        width: 1.5em;
        height: 1.5em;
        display: inline-block;
        border: 1px solid #D6E5F3;
        background-color: #ffffff;
        font-size: inherit;
        padding: 0;
        margin: 0;
    }
    .checkbox .icon {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 0.75em;
        max-height: 0.75em;
        opacity: 0;
        transition-property: opacity;
        transition-duration: 0.3s;
    }
    .checkbox.checked .icon {
        opacity: 1;
    }
    .checkbox.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>