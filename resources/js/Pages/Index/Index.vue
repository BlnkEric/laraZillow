<template>
        <div>
            Main Page
        </div>
        <div>{{ message }}</div>
</template>

<script setup>
    import {Link} from '@inertiajs/inertia-vue3';
    defineProps({
        message : String
    })
</script>