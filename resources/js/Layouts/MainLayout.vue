<template>
    <Link rel="stylesheet" href="/">Go to Home</Link>&nbsp;
    <Link rel="stylesheet" href="/show">Go to show</Link>
    <div>Timer is {{ timer }}</div>
    <slot>Default</slot>
</template>

<script setup>
    import {Link} from '@inertiajs/inertia-vue3'
    import {ref} from 'vue'

    const timer = ref(0)
    setInterval(() => timer.value++, 1000)
</script>