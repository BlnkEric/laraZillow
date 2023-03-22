<template>
    <Box class="mx-5">
        <template #header>
            Uploade Images
        </template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-1 my-5">
                <input
                    type="file" multiple class="border border-gray-200 dark:border-gray-700 rounded-md file:py-2 file:px-4 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-200 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-300 file:dark:hover:bg-gray-700 file:hover:cursor-pointer"
                    @input="addFiles"
                />
                <button type="submit" class="btn-outline disabled:opacity-40 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
                <button type="reset" class="btn-outline" @click="reset">Reset</button>
            </section>
        </form>
    </Box>
    <Box class="m-5">
        <template #header>
            Current Listing Images
        </template>
        <section class="mt-4 grid grid-cols-3 gap-4 place-items-center">
            <div v-for="image in listing.images" :key="image.id">
                <img :src="image.src" alt="jesus" class="rounded-md" />
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Nprogress } from 'nprogress'

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        Nprogress.set((event.detail.progress.percentage / 100) * 0.9)        
    }
})

const props = defineProps({
    listing: Object,
})

const imageForm = useForm({
    images: [],
})

const canUpload = computed(() => imageForm.images.length)

const upload = () => {
    imageForm.post(route('realtor.listings.image.store', { listing: props.listing.id})),
    {
        onSuccess: imageForm.reset('images'),

    }
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        imageForm.images.push(image)
    }
}

const reset = () => {
    imageForm.reset('images')
}

</script>