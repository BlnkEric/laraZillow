<template>
    <form @submit.prevent="update">
        <div class="grid grid-col-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input v-model.number="form.beds" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Baths</label>
                <input v-model.number="form.baths" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input v-model.number="form.area" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input v-model="form.code" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input v-model.number="form.street_nr" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-6">
                <label class="label">Price</label>
                <input v-model.number="form.price" type="text" class="input" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>
            <div class="col-span-6">
                <button type="submit" class="btn-primary" @click="triggerValidInputs">Edit</button>
            </div>
        </div>
    </form>
</template>
<script setup>


import { useForm } from '@inertiajs/inertia-vue3'
const props = defineProps({
    listing: Object,
})
const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
})
// eslint-disable-next-line no-undef
const update = () => form.put(route('listings.update', {listing: props.listing.id}))
</script>
  
<script>
export default {
    data() {
        return {
            display: 'none',
        }
    },

    methods: {
        triggerValidInputs() {
            this.display = 'block'
        },
    },
}
</script>


<style scoped>

.afterValidate {
  /* padding: 2px; */
  /* margin: 10px 0 10px 0; */
  /* display:  "(v-bind(display)!= null) ? v-bind(display) : 'none'"; */
  display: v-bind(display);
}

span {
    background-color: rgb(235, 91, 91);
    color: aliceblue;
    border-radius: 10px;
    padding: 2px;
}

.validated {
    color: green;
}
</style>