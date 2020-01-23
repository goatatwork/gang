<template>
    <div>
        <div class="form-group">
            <label for="ip-input">IP</label>
            <input id="ip-input" type="text" name="ip" class="form-control" v-model="formData.ip">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="scanTypeRadios1" name="scanType" value="ping" v-model="formData.scanType">
                <label class="form-check-label" for="scanTypeRadios">
                    Ping
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="scanTypeRadios2" name="scanType" value="system_info" v-model="formData.scanType">
                <label class="form-check-label" for="scanTypeRadios">
                    Get System Info
                </label>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success form-control" @click.stop="submit">
                <i :class="spinnerIcon"></i>
                Scan
            </button>
        </div>

        <div class="row">
            <div class="col">
                <pre>
{{ result.result }}
                </pre>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            action: {
                type: String,
                default() {
                    return 'someUri'
                }
            }
        },

        data() {
            return {
                result: '',
                formData: {
                    ip: '',
                    scanType: 'system_info'
                },
                working: false,
            }
        },

        computed: {
            csrfToken() {
                return (window.Laravel.csrf_token) ? window.Laravel.csrf_token : '';
            },
            spinnerIcon() {
                return {
                    'fa-spin': this.working,
                    'fas fa-spinner': this.working,
                    'far fa-dot-circle': ! this.working,
                }
            }
        },

        methods: {
            submit() {
                this.working = true;
                axios.post(this.action, this.formData).then( (response) => {
                    this.result = response.data;
                    this.working = false;
                }).catch( (error) => {
                    console.log(error.response.data);
                    this.working = false;
                });
            }
        }
    }
</script>
