<template>
    <li class="list-group-item" :class="messageClasses">
        <div class="media">
            <span
                :class="dismissButtonClasses"
                @mouseover="hovering = true"
                @mouseleave="hovering = false"
                @click="dismiss"
            >dismiss</span>
            <div class="media-body">
                {{ message.created_at }} - {{ message.message }}
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        props: {
            message: {},
        },

        data() {
            return {
                hovering: false,
                isBeingDisplayed: true
            }
        },

        computed: {
            dismissButtonClasses() {
                return {
                    'font-italic': (this.hovering) ? false : true,
                    'text-secondary': (this.hovering) ? false : true,
                    'text-danger': (this.hovering) ? true : false,
                    'mr-3': true
                }
            },
            messageClasses() {
                return {
                    fade: true,
                    show: this.isBeingDisplayed,
                }
            }
        },

        methods: {
            dismiss() {
                this.$emit('dismiss-message', this.message);
            }
        }
    }
</script>
