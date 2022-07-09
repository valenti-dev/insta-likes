<template>
    <div class="account" @click="select" :class="value === username ? 'selected' : ''">
        <div class="indicator"></div>
        <div class="avatar" :style="{'background-image': 'url('+avatar_url(avatar)+')'}"></div>
        <div class="username">{{ username }}</div>
        <div class="actions">
            <button class="action rm_action" @click.stop.prevent="remove"></button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "account",
        props: {
            value: {},
            username: {},
            avatar: {},
        },
        methods: {
            select() {
                this.$emit('input', this.username);
                this.$emit('click');
            },
            remove() {
                this.$emit('remove');
            },
            avatar_url(api_url) {
                var params = new URLSearchParams({
                    url: api_url,
                });
                return '/api/avatar.php?'+params;
            },
        },

    }
</script>

<style scoped>
    .account {
        display: flex;
        height: 6.25em;
        box-sizing: border-box;
        border-radius: 2em;
        border: 1px solid #CCCCCC;
        padding: 0 1em;
        align-items: center;
        cursor: pointer;
        transition-property: border-color, color;
        transition-duration: 0.3s;
    }
    .account.error {
        border-color: #FA655C;
    }
    .account:hover,
    .account.selected {
        border: 1px solid #5CBE72;
    }
    .account:hover {
        color: #5CBE72;
    }
    .account:not(:last-child) {
        margin-bottom: 0.625em;
    }
    .indicator {
        width: 1.5em;
        height: 1.5em;
        box-sizing: border-box;
        margin-right: 1em;
        border-radius: 50%;
        border: 1px solid #C4C4C4;
        transition-property: border-color, background-color;
        transition-duration: 0.3s;
    }
    .account.selected .indicator {
        border-color: #5CBE72;
        background-color: #5CBE72;
    }
    .avatar {
        width: 3.5em;
        height: 3.5em;
        border-radius: 50%;
        background-position: center;
        background-size: cover;
        margin-right: 1em;
    }
    .username {
        flex-grow: 1;
        font-weight: 600;
        line-height: 1.68;
        max-width: calc(100% - 9.5em);
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .actions {
        margin-left: 1em;
    }
    .action {
        font-size: inherit;
        width: 1.5em;
        height: 1.5em;
        margin: 0;
        padding: 0;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        background-color: transparent;
        border: none;
        cursor: pointer;
        transition-property: background-image;
        transition-duration: 0.3s;
    }
    .rm_action {
        background-image: url(/img/icons/rm-ccc.svg);
    }
    .rm_action:hover {
        background-image: url(/img/icons/rm-fa655c.svg);
    }
</style>