<template>
    <MainLayout>
        <div>
            Main Page
        </div>
        <div>{{ message }}</div>
    </MainLayout>
</template>

<script setup>
    import {Link} from '@inertiajs/inertia-vue3';
    import MainLayout from '../../Layouts/MainLayout.vue';
    defineProps({
        message : String
    })
</script>