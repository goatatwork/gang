<template>
    <div class="row">
        <div class="col">
            <ul class="list-unstyled text-right" style="font-size:.85rem;">
                <li>

                    <div class="btn-group bt-group-sm" role="group" aria-label="Toolbar">
<!--                         <button type="button" class="btn btn-dark">One</button>
                        <button type="button" class="btn btn-dark">Three</button> -->

<!--                         <button type="button" class="btn btn-sm btn-dark" @click="clearMessages">
                            <span class="fas fa-sync" :class="spinnerIconClasses"></span>
                            Clear Backchannel
                        </button> -->

                        <button class="btn btn-link text-dark" @click="clearMessages">
                            <span class="fas fa-sync" :class="spinnerIconClasses"></span>
                            Clear Backchannel
                        </button>
                    </div>

                </li>
                <li v-for="message in messages" :class="messageClasses">{{ message }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                spinnerIconClasses: {
                    'fas': true,
                    'fa-sync': true,
                    'fa-spin': false,
                },
                messageClasses: {
                    'fade': false,
                    'show': true,
                },
                messages: ['...'],
            }
        },

        mounted() {
            this.listenUp();
        },

        methods: {
            clearMessages() {
                this.messageClasses.show = false;

                this.spinnerIconClasses = {
                    'fas': true,
                    'fa-sync': true,
                    'fa-spin': true,
                };

                setTimeout( () => {
                    this.spinnerIconClasses = {
                        'fas': true,
                        'fa-sync': true,
                        'fa-spin': false,
                    };

                    this.messageClasses.show = true;
                    this.messages = ['...'];
                }, 1000);
            },

            listenUp() {
                Echo.channel('back_channel').listen('BackchannelMessage', (e) => {
                    this.messages.unshift(e.message);
                });
            },
        }
    }
</script>
