<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex justify-between items-end">
                <div class="flex gap-4 text-indigo-600 dark:text-indigo-300 font-bold">
                    <Link class="text-5xl" rel="stylesheet" :href="route('listings.index')">BlnkEric</Link>
                </div>

                <div class="flex gap-3 items-end">
                    <Link v-if="user" :href="route('notifications.index')" class="relative">
                        <font-awesome-icon class="text-xl text-amber-300 px-4 py-1" icon="fa-bell" />
                        <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-500 font-medium border border-white dark:border-gray-900 rounded-full text-center text-xs">
                            {{ notificationCount }}
                        </div>
                    </Link>
                    <Link class="btn-primary max-[768px]:text-sm max-[560px]:text-xs" rel="stylesheet" :href="route('listings.index')">Listings</Link>&nbsp;
                    <div v-if="user" class="flex gap-2 items-end">
                        <div class="btn-primary max-[768px]:text-sm max-[560px]:text-xs">
                            <Link :href="route('realtor.listings.index')">
                                {{ user.name }}
                            </Link>
                        </div>
                        <Link rel="stylesheet" :href="route('realtor.listings.create')" class="btn-primary max-[768px]:text-sm max-[560px]:text-xs">+ New Listing</Link>
                        <Link rel="stylesheet" :href="route('logout')" method="delete" as="button" class="btn-primary max-[768px]:text-sm max-[560px]:text-xs">Logout</Link>
                    </div>
                    <div v-else class="flex items-end gap-2">
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
        <slot>Default</slot>
    </main>
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

const notificationCount = computed(
    () => Math.min(page.props.value.user.notificationCount,9),
)
//timer
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>
