<template>
    <div class="row">
        <div class="col text-light">
            <input type="file" @change="inputChanged">
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.onboot();
        },

        data() {
            return {
                input: null,
                reader: new FileReader(),
            }
        },

        methods: {
            inputChanged(e) {
                console.log(this.input.files);
            },

            onboot() {
                this.input = document.querySelector('input[type=file]');
                this.reader.onload = function() {
                    console.log(this.reader.result);
                };
                this.reader.readAsText(this.input.files[0]);
            }
        }
    }
</script>
