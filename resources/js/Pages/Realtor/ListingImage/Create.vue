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

        <div v-if="imageErrors.length" class="mt-2 errorContainer">
            <span v-for="(error, index) in imageErrors" :key="index" class="spanError">{{ error }}</span>
        </div>
    </Box>
    <Box class="m-5">
        <template #header>
            Current Listing Images
        </template>
        <section v-if="!listing.images.length" class="p-10 w-full text-center font-medium text-gray-500">
            No images Yet
        </section>
        <section v-else class="mt-4 grid grid-cols-3 gap-4 place-items-end">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="image.src" alt="jesus" class="rounded-md" />
                <Link
                    :href="route('realtor.listings.image.destroy', {listing: props.listing.id , image: image.id})"
                    method="delete"
                    as="button"
                    class="btn-outline mt-1 text-sm font-semibold"
                >
                    Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
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

const imageErrors = computed(() => Object.values(imageForm.errors))

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
