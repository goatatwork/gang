<template>
<div class="card shadow" style="width:24rem;">
    <div class="card-body">

        <div class="row">
            <div class="col">
                <p class="card-text" style="font-size:.85rem">
                    Do you have DHCP config files that you need to import? You can place them in the project's <span class="font-weight-bold bg-warning">storage/app/public/imports</span> folder, or you can upload them here.
                </p>
            </div>
        </div>


    </div>

    <div class="card-footer">
        <form method="POST" :action="formAction" class="form" enctype="multipart/form-data">

            <input type="hidden" name="_token" :value="csrfToken">

            <div class="form-group">
                <label for="file_upload_input" class="sr-only">Choose File</label>
                <input type="file" multiple="mulitple" id="file_upload_input" class="form-control-file form-control-sm" name="files_to_import[]">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success mr-2">Upload</button>
                <button type="button" class="btn btn-sm btn-danger">Cancel</button>
            </div>

        </form>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            formAction: {
                type: String,
                default() {
                    return 'someUri'
                }
            }
        },

        computed: {
            csrfToken() {
                return (window.Laravel.csrf_token) ? window.Laravel.csrf_token : '';
            }
        },
    }
</script>
