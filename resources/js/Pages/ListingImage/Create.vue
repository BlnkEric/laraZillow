<template>
    <form method="post" enctype="multipart/form-data" :action="route('realtor.listings.image.store', {listing: listing.id})">
        <input type="file" multiple name="images[]" />
        <button type="submit">Send</button>
    </form>
</template>

<script setup>

const props = defineProps({
    listing: Object,
})

</script>