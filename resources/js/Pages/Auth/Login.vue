<template>
    <div class="w-1/2 mx-auto">
        <form @submit.prevent="login">
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
                <!-- <div v-else class="afterValidate mt-2">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div> -->
            </div>
            <div class="mt-2">
                <button type="submit" class="btn-primary w-full" @click="triggerValidInputs">Login</button>
            </div>
            <div class="mt-2 text-center text-gray-500">
                <Link :href="route('user-account.create')">Need an account? cleck here</Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useValidationPass } from '@/Composables/useValidationPass'
import { useForm, Link } from '@inertiajs/inertia-vue3'

const form = useForm({
    email : null,
    password : null,
})

const { validationPass } = useValidationPass(form)

const login = () => form.post(route('login.store'))
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