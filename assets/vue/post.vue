<template>
    <div class="post" :style="{'background-image': ('url('+post.img+')')}" :class="{
        selected: selected,
    }" @click="click"></div>
</template>

<script>
    export default {
        name: "post",
        props: {
            post: {},
            value: {},
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
        transition-property: border-color;
        transition-duration: 0.3s;
    }
    .post:hover,
    .post.selected {
        border-color: #5CBE72;
    }
    .post:before {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30%;
        height: 30%;
        background-repeat: no-repeat;
        background-position: center;
        background-image: url(/img/icons/checked-5cbe72.svg);
        opacity: 0;
        transition-property: opacity;
        transition-duration: 0.3s;
    }
    .post.selected:before {
        opacity: 1;
    }
</style>