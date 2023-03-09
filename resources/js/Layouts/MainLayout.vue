<template>
    <Link rel="stylesheet" href="/">Go to Home</Link>&nbsp;
    <Link rel="stylesheet" href="/show">Go to show</Link>
    <slot>Default</slot>
</template>

<script setup>
    import {Link} from '@inertiajs/inertia-vue3'
</script>