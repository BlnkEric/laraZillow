<template>
    <div v-for="listing in listings" :key="listing.id" class="listings">
        <div>
            <Link :href="route('listings.show', {listing: listing.id})">
                <ListingAddress :listing="listing" />
            </Link>
        </div>
        <div>
            <Link :href="route('listings.edit', {listing: listing.id})">Edit</Link>
        </div>
        <div>
            <Link :href="route('listings.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ListingAddress from '../Components/listingAddress.vue'

defineProps({
    listings : Array,
})
</script>

<style scoped>
.listings {
  padding: 2px;
  /* margin: 10px 0 10px 0; */
  display: flex;
  flex-wrap: wrap;
  background-color: rgb(160, 160, 160);
}

.listings div {
    flex: 0 0 33%;
}


</style>