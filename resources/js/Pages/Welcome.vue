<template>
    <layout>
        <div>
        This is welcome page
    </div>
    </layout>
</template>

<script>
    import Layout from './Layout'

    export default {
        components: {
            Layout,
        },
        props: {
            user: Object,
        },
    }
</script>
