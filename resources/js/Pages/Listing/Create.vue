<template>
    <form @submit.prevent="create">
        <div>
            <div>
                <label>Beds</label>
                <input v-model.number="form.beds" type="text" />
                <div v-if="form.errors.beds">
                    <span>{{ form.errors.beds }}</span>
                </div>                
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Baths</label>
                <input v-model.number="form.baths" type="text" />
                <div v-if="form.errors.baths">
                    <span>{{ form.errors.baths }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Area</label>
                <input v-model.number="form.area" type="text" />
                <div v-if="form.errors.area">
                    <span>{{ form.errors.area }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                    <!-- <font-awesome-icon icon="fa-hat-wizard" /> -->
                    <!-- <font-awesome-icon icon="fa-solid fa-camera" /> -->
                    <!-- <icon style="height: 20px; width: 20px;" /> -->
                </div>
            </div>

            <div>
                <label>City</label>
                <input v-model="form.city" type="text" />
                <div v-if="form.errors.city">
                    <span>{{ form.errors.city }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Post Code</label>
                <input v-model="form.code" type="text" />
                <div v-if="form.errors.code">
                    <span>{{ form.errors.code }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Street</label>
                <input v-model="form.street" type="text" />
                <div v-if="form.errors.street">
                    <span>{{ form.errors.street }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Street Nr</label>
                <input v-model.number="form.street_nr" type="text" />
                <div v-if="form.errors.street_nr">
                    <span>{{ form.errors.street_nr }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <label>Price</label>
                <input v-model.number="form.price" type="text" />
                <div v-if="form.errors.price">
                    <span>{{ form.errors.price }}</span>
                </div>
                <div v-else class="afterValidate">
                    <font-awesome-icon class="validated" icon="fa-solid fa-check-circle" />
                </div>
            </div>

            <div>
                <button type="submit" @click="triggerValidInputs()">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

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

// const display = 'none'

// functions
// function triggerValidInputs() {
//     display = 'block';
// }

// function triggerValidInputs() {
//     this.display = 'block';
// }

const create = () => form.post('/listings')
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
label {
  margin-right: 2em;
}

form div div {
  padding: 2px;
  /* margin: 10px 0 10px 0; */
  display: flex;
}

form div:not(:last-child) div:last-child {
    margin-left: 5px;
}
.afterValidate {
  /* padding: 2px; */
  /* margin: 10px 0 10px 0; */
  display:  v-bind(display);
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