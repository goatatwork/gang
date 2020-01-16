<template>
    <li class="list-group-item">
        {{ message.created_at }} - {{ message.message }}
    </li>
</template>

<script>
    export default {
        props: {
            message: {},
        },
    }
</script>
