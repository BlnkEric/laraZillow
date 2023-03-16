<template>
    <Link rel="stylesheet" href="/">Go to Home</Link>&nbsp;
    <Link rel="stylesheet" href="/show">Go to show</Link>
    <Link rel="stylesheet" href="/listings">Go to listings</Link>
    <!-- <div>Timer is {{ timer }}</div> -->
    <div v-if="successFlash" class="success">
        {{ successFlash }}
    </div>
    <slot>Default</slot>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3'
// import {ref, computed} from 'vue'
import {computed} from 'vue'

defineProps({
    errors: String,
})

// page.props.value.flash.success
const page = usePage()
const successFlash = computed(
    () => page.props.value.flash.success,
)

//timer
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>