<template>
    <div class="w-1/2 mx-auto">
        <form @submit.prevent="register">
            <div class="mt-2">
                <label for="name" class="label">Name</label>
                <input id="name" v-model="form.name" type="text" class="input" />
                <div v-if="form.errors.name" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.name }}</span>
                </div>
                <div v-else class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>
            <div class="mt-2">
                <label for="email" class="label">E-mail (username)</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="form.errors.email" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.email }}</span>
                </div>
                <div v-else class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>
            <div class="mt-2">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <div v-if="form.errors.password" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.password }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input" />
            </div>
            <div class="mt-2">
                <button type="submit" class="btn-primary" @click="triggerValidInputs">Create Account</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useValidationPass } from '@/Composables/useValidationPass'
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
    name : null,
    email : null,
    password : null,
    password_confirmation : null,
})

const { validationPass } = useValidationPass(form)

const register = () => form.post(route('user-account.store'))

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

/* span {
    background-color: rgb(235, 91, 91);
    color: aliceblue;
    border-radius: 10px;
    padding: 2px;
} */

.validated {
    color: green;
}
</style>