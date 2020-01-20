<template>
    <ul class="list-group">
        <backchannel-message v-for="message in messageList"
            :key="message.id"
            :message="message"
            @dismiss-message="dismiss"
        ></backchannel-message>
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
                placeholderId: 1
            }
        },

        mounted() {
            this.listenUp();
            this.setPlaceholderId();
        },

        methods: {
            dismiss(message) {
                this.markRead(message);
                let index = this.messageList.indexOf(message);
                this.messageList.splice(index, 1);
            },

            listenUp() {
                Echo.channel('back_channel').listen('BackchannelMessage', (e) => {
                    var newMessage = {
                        id: this.placeholderId,
                        active: true,
                        created_at: moment().format('YYYY-MM-DD h:mm:ss'),
                        message: e.message
                    }

                    this.messageList.unshift(newMessage);

                    this.placeholderId = this.placeholderId + 1;

                });
            },

            markRead(message) {
                axios.patch('/backchannel/'+message.id+'/markread', message).then( (response) => {
                    // console.log(response.data);
                    // console.log('I just marked backchanell message '+message.id+' read.');
                }).catch( (error) => {
                    console.log(error.response.data);
                });
            },

            setPlaceholderId() {
                if ( _.orderBy(this.messages,['id'],['desc'])[0] ) {
                    this.placeholderId = _.orderBy(this.messages,['id'],['desc'])[0].id + 1;
                } else {
                    this.placeholderId = 1;
                }
            }
        }
    }
</script>
