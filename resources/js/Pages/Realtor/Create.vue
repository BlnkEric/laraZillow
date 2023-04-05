<template>
    <form @submit.prevent="create">
        <div class="grid grid-col-6 gap-4 mx-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input v-model.number="form.beds" type="text" class="input" />
                <div v-if="form.errors.beds" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.beds }}</span>
                </div>                
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input v-model.number="form.baths" type="text" class="input" />
                <div v-if="form.errors.baths" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.baths }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input v-model.number="form.area" type="text" class="input" />
                <div v-if="form.errors.area" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.area }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                    <!-- <font-awesome-icon icon="fa-hat-wizard" /> -->
                    <!-- <font-awesome-icon icon="fa-solid fa-camera" /> -->
                    <!-- <icon style="height: 20px; width: 20px;" /> -->
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class="input" />
                <div v-if="form.errors.city" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.city }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input v-model="form.code" type="text" class="input" />
                <div v-if="form.errors.code" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.code }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class="input" />
                <div v-if="form.errors.street" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.street }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input v-model.number="form.street_nr" type="text" class="input" />
                <div v-if="form.errors.street_nr" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.street_nr }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input v-model.number="form.price" type="text" class="input" />
                <div v-if="form.errors.price" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.price }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}" class="afterValidate mt-2">
                    <!-- <font-awesome-icon class="validated" :icon="dynamicIcon" /> -->
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>

            <div class="col-span-6">
                <button
                    type="submit" class="btn-primary" 
                    @click="displayFontAwesome.display='block'"
                >
                    Create
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
// import { computed } from 'vue'
import { useValidationPass } from '@/Composables/useValidationPass'
import { computed, reactive , watch } from 'vue'
import { debounce } from 'lodash'

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

//without composables !! 
// const validationPass = computed(() => {
//     if (!form.hasErrors){
//         return 'fa-solid fa-spinner'
//     }else{
//         return 'fa-solid fa-check-circle'
//     }
// })

const displayFontAwesome = reactive({
    display: 'none', 
})


watch(() => form.hasErrors, debounce(() => {
    if(validationPass == 'fa-solid fa-spinner'){
        displayFontAwesome.display = 'none'
    }
}
, 1000),
)

const { validationPass } = useValidationPass(form)

// eslint-disable-next-line no-undef
const create = () => form.post(route('realtor.listings.store'))
</script> 

<script>
export default {
    // data() {
    //     return {
    //         display: 'none',
    //     }
    // },

    // methods: {
    //     triggerValidInputs() {
    //         this.display = 'block'
    //     },
    // },
}
</script>

<style scoped>  
.afterValidate {
  /* padding: 2px; */
  /* margin: 10px 0 10px 0; */
  /* display:  "(v-bind(display)!= null) ? v-bind(display) : 'none'"; */
  display: v-bind(display);
}

.validated {
    color: green;
}
</style>