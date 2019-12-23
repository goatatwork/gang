<template>
    <div class="row">
        <div class="col">

            <form id="trix-editor-form" method="POST" :action="postUrl">

                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a :href="theFile.return_to" class="btn btn-sm btn-danger">Cancel</a>

                <input type="hidden" name="_token" :value="csrfToken">

                <input v-if="theFile.file_name" type="hidden" name="load" v-model="theFile.file_name">
                <input v-if="!theFile.file_name" type="text" name="load" class="form-control form-control-sm">

                <input type="hidden" name="return_to" v-model="theFile.return_to">

                <input type="hidden" name="content" id="trix-editor-content" :value="theFile.content">
                <trix-editor input="trix-editor-content"
                    @trix-attachment-add="trixAttachmentAdd"
                    @trix-attachment-remove="trixAttachmentRemove"
                ></trix-editor>

                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a :href="theFile.return_to" class="btn btn-sm btn-danger">Cancel</a>

            </form>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            fileContent: {
                type: String,
                default() {
                    return 'default content here, motherfucker';
                }
            },
            fileName: {
                type: String,
                required: false
            },
            postUrl: {
                type: String,
                default() {
                    return 'posturl';
                }
            },
            returnTo: {
                type: String,
                default() {
                    return '/dnsmasq'
                }
            },
        },

        data() {
            return {
                theFile: {
                    content: this.fileContent,
                    file_name: (this.fileName) ? this.fileName : null,
                    return_to: (this.returnTo) ? this.returnTo : this.postUrl
                }
            }
        },

        computed: {
            csrfToken() {
                return (window.Laravel.csrf_token) ? window.Laravel.csrf_token : '';
            }
        },

        methods: {
            test() {
                // console.log(this.$refs.attachments.files)
            },
            trixAttachmentAdd(event) {
                if (event.attachment.file) {
                    console.log('added');
                }
            },
            trixAttachmentRemove(event) {
                console.log('remove file')
                console.log(event);
                // if (event.attachment.file) {
                //     this.uploadFile(event.attachment);
                // }
            },
            uploadFile(attachment) {
                console.log('upload file');
            }
        }
    }
</script>

<style lang="scss">
.trix-button-group--text-tools { display: none !important; }
.trix-button-group--block-tools { display: none !important; }
.trix-button-group--file-tools { display: none !important; }
</style>
