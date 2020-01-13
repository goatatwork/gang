<template>
    <span>
        {{ startToDisplay }}
    </span>
</template>

<script>
    export default {
        props: {
            calendar: {
                type: Boolean,
                default() {
                    return false
                }
            },
            fromNow: {
                type: Boolean,
                default() {
                    return false
                }
            },
            start: {
                type: String,
                default() {
                    return ''
                }
            }
        },

        computed: {
            startTime() {
                return (this.start) ? moment(this.start) : moment();
            },
            startToDisplay() {
                if (this.calendar) {
                    return this.startTime.calendar();
                }

                if (this.fromNow) {
                    return this.startTime.fromNow();
                }

                return this.startTime;
            }
        }
    }
</script>
