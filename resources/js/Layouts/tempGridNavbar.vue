<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 grid grid-rows-1 grid-flow-col items-center gap-4">
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold col-span-2 place-content-start bg-black">
                    <Link rel="stylesheet" :href="route('listings.index')">BlnkEric</Link>
                </div>
                <div class="grid grid-rows-1 grid-flow-col items-center place-content-end">
                    <div class="text-lg font-medium">
                        <Link rel="stylesheet" :href="route('listings.index')">Listings</Link>&nbsp;
                    </div>
                    <div v-if="user" class="flex gap-4 items-center">
                        <div class="dark:text-gray-300">
                            {{ user.name }}
                        </div>
                        <Link rel="stylesheet" :href="route('listings.create')" class="btn-primary">Add New Listing</Link>
                        <Link rel="stylesheet" :href="route('logout')" method="delete" as="button" class="btn-primary">Logout</Link>
                    </div>
                    <div v-else class="flex items-center gap-2">
                        <Link rel="stylesheet" :href="route('user-account.create')" class="btn-primary">Register</Link>
                        <Link rel="stylesheet" :href="route('login')" class="btn-primary">Login</Link>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <!-- <div>Timer is {{ timer }}</div> -->
        <div v-if="successFlash" class="mb-4 border rounded-md shadow-sm border-green-300 dark:border-green-600 bg-green-100 dark:bg-green-900 p-4">
            {{ successFlash }}
        </div>
    </main>
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
const user = computed(
    () => page.props.value.user,
)
//timer
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>