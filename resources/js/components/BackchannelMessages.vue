<template>
    <ul class="list-group">
        <backchannel-message v-for="message in messageList" :key="message.id" :message="message"></backchannel-message>
    </ul>
</template>

<script>
    var BackchannelMessage = Vue.extend(require('./BackchannelMessage.vue').default);

    export default {
        props: {
            messages: {},
        },

        components: {
            'backchannel-message': BackchannelMessage,
        },

        data() {
            return {
                messageList: this.messages,
            }
        },

        mounted() {
            this.listenUp();
        },

        methods: {
            listenUp() {
                Echo.channel('back_channel').listen('BackchannelMessage', (e) => {
                    var newMessage = {
                        id: 99,
                        active: true,
                        created_at: moment().format('YYYY-MM-DD h:mm:ss'),
                        message: e.message
                    }

                    this.messageList.unshift(newMessage);

                });
            },
        }
    }
</script>
