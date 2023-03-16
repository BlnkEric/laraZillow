<template>
    <form @submit.prevent="create">
        <div class="grid grid-col-6 gap-4">
            <div class="col-span-2">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Beds</label>
                <input v-model.number="form.beds" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.beds">
                    <span>{{ form.errors.beds }}</span>
                </div>                
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Baths</label>
                <input v-model.number="form.baths" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.baths">
                    <span>{{ form.errors.baths }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Area</label>
                <input v-model.number="form.area" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.area">
                    <span>{{ form.errors.area }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                    <!-- <font-awesome-icon icon="fa-hat-wizard" /> -->
                    <!-- <font-awesome-icon icon="fa-solid fa-camera" /> -->
                    <!-- <icon style="height: 20px; width: 20px;" /> -->
                </div>
            </div>

            <div class="col-span-4">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">City</label>
                <input v-model="form.city" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.city">
                    <span>{{ form.errors.city }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Post Code</label>
                <input v-model="form.code" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.code">
                    <span>{{ form.errors.code }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-4">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Street</label>
                <input v-model="form.street" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.street">
                    <span>{{ form.errors.street }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Street Nr</label>
                <input v-model.number="form.street_nr" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.street_nr">
                    <span>{{ form.errors.street_nr }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-6">
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Price</label>
                <input v-model.number="form.price" type="text" class="block w-full rounded-md shadow-sm border border-gray-400 dark:border-gray-600 text-gray-800" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <!-- <font-awesome-icon class="validated" :icon="dynamicIcon" /> -->
                    <font-awesome-icon class="validated" icon="fa-solid fa-spinner" />
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" class="bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-500 text-white font-medium p-2 rounded-md" @click="triggerValidInputs">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
// import { reactive, ref } from 'vue';

const form = useForm({
    baths : 0,
    beds : 0,
    area : 0,
    city : 'city valid placeholder',
    code : null,
    street : null,
    street_nr : null,
    price : 0,
})

// const dynamicIcon = reactive({
//     'fa-solid': true,
//     'fa-spinner': true,
//     'fa-check-circle': false,
// })

// const aaa = ref(0)

// setInterval(() => {
//     aaa.value++
//     if(aaa.value === 15) {
//         dynamicIcon['fa-check-circle'] = true
//         dynamicIcon['fa-spinner'] = false
//     }
// }, 1000)

// defineProps({
//     display: {
//         type: String,
//         default: 'none',
//     },
// })

// const display = 'none'

// functions
// function triggerValidInputs() {
//     display = 'block'
// }

// function triggerValidInputs() {
//     this.display = 'block';
// }


// eslint-disable-next-line no-undef
const create = () => form.post(route('listings.store'))
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