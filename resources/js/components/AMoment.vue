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
                return (this.calendar) ? this.startTime.calendar() : this.startTime;
            }
        }
    }
</script>
