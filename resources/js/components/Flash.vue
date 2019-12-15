<template>
    <div class="toast" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <span class="fas fa-square mr-2 text-primary"></span>
            <strong class="mr-auto">Status Message</strong>
            <small>Just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ message }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            message: '',
        },

        mounted() {
            $('.toast').toast(this.toastOptions);

            if (this.message) {
                this.showToast();
            }
        },

        data() {
            return {
                toastOptions: {
                    animation: true,
                    autohide: true,
                    delay: 10000,
                }
            }
        },

        methods: {
            hideToast() {
                $('.toast').toast('hide');
            },
            showToast() {
                $('.toast').toast('show');
            }
        }

    }
</script>
