<template>
    <Link rel="stylesheet" href="/">Go to Home</Link>&nbsp;
    <Link rel="stylesheet" href="/show">Go to show</Link>
    <Link rel="stylesheet" href="/listings">Go to listings</Link>
    <div>Timer is {{ timer }}</div>
    <div class="success" v-if="page.props.value.flash.success">
        {{ page.props.value.flash.success }}
    </div>
    <slot>Default</slot>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {ref} from 'vue'

defineProps({
    errors: String,
})

// page.props.value.flash.success
const page = usePage();

const timer = ref(0)
setInterval(() => timer.value++, 1000)
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>