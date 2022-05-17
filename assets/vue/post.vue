<template>
    <div class="post" :style="{'background-image': ('url('+post.img+')')}" :class="{
        selected: selected,
    }" @click="click">
        <div class="selected_qty">
            <img class="icon" alt="" :src="icon_url">
            <span class="qty">{{ qty }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "post",
        props: {
            post: {},
            value: {},
            qty: {},
            service: {},
        },
        methods: {
            click() {
                var new_val = [];
                if(this.selected) {
                    this.value.forEach((_post) => {
                        if(_post.link !== this.post.link) {
                            new_val.push(_post);
                        }
                    });
                } else {
                    this.value.forEach((_post) => {
                        new_val.push(_post);
                    });
                    new_val.push(this.post);
                }
                this.$emit('input', new_val);
            },
        },
        computed: {
            selected() {
                return !this.value.every((_post) => {
                    return _post.link !== this.post.link;
                });
            },
            icon_url() {
                return '/img/icons/'+this.service.toLowerCase()+'-fff.svg'
            },
        },
    }
</script>

<style scoped>
    .post {
        width: 6.5em;
        height: 6.5em;
        border: 1px solid #CCCCCC;
        box-sizing: border-box;
        border-radius: 2em;
        background-position: center;
        background-size: cover;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition-property: border-color;
        transition-duration: 0.3s;
    }
    .post:hover {
        border-color: #5CBE72;
    }
    .post .selected_qty {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        opacity: 0;
        background-color: rgba(92, 190, 114, 0.5);
        color: #ffffff;
        transition-property: opacity;
        transition-duration: 0.3s;
    }
    .post .selected_qty .icon {
        max-width: 1.5em;
        max-height: 1.5em;
    }
    .post .selected_qty .qty {
        line-height: 1.685;
        font-size: 1.375em;
        font-weight: 600;
    }
    .post.selected .selected_qty {
        opacity: 1;
    }
    @media(max-width: 767px) {
        .post .selected_qty .icon {
            max-width: 1em;
            max-height: 1em;
        }
        .post .selected_qty .qty {
            font-size: 0.75em;
        }
    }
</style>
