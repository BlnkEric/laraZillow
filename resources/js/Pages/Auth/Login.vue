<template>
    <div v-if="failedFlash" class="mb-4 border rounded-md shadow-sm border-red-300 dark:border-red-600 bg-green-100 dark:bg-red-900 p-4">
        {{ failedFlash }}
    </div>
    <div class="w-1/2 mx-auto">
        <form @submit.prevent="login">
            <div class="mt-2">
                <label for="email" class="label">E-mail (username)</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="form.errors.email" class="mt-2 errorContainer">
                    <span class="spanError">{{ form.errors.email }}</span>
                </div>
                <div v-else-if="displayFontAwesome.display == 'block'" :class="{'aftervalidate mt-2': displayFontAwesome.display == 'block'}">
                    <font-awesome-icon class="validated" :icon="validationPass" />
                </div>
            </div>
            <!-- {{ form.flash }}
            {{ form.errors }} -->
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
            <div class="flex items-center mt-2 gap-2">
                <button
                    type="submit" 
                    class="btn-primary w-full" 
                    :class="{'bg-slate-500 cursor-not-allowed hover:bg-gray-500': isSignupButtonDisabled || tooManyRequest}" 
                    :disabled="isSignupButtonDisabled || tooManyRequest" 
                    @click="displayFontAwesome.display='block'"
                >
                    Login
                </button>
                <div v-if="!resetTimer && tooManyRequest" class="bg-red-500 p-2 text-center rounded-md text-red-900">{{ timer }}</div>
            </div>
            <div class="mt-2 text-center text-gray-500">
                <Link :href="route('user-account.create')">Need an account? cleck here</Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useValidationPass } from '@/Composables/useValidationPass'
import { useForm, usePage, Link } from '@inertiajs/inertia-vue3'
import { debounce } from 'lodash'
import { computed, reactive , watch, ref } from 'vue'
import { useSubmitButtonState } from '@/Composables/useSubmitButtonState'

// const props = defineProps({
//     flashMessages: Object,
// })

const page = usePage()

const failedFlash = computed(
    () => page.props.value.flash.alert,
)

const form = useForm({
    email : null,
    password : null,
})

const displayFontAwesome = reactive({
    display: 'none', 
})

const { validationPass } = useValidationPass(form)

watch(() => form.hasErrors, debounce(() => {
    displayFontAwesome.display = 'none'
}
, 1000),
)

const { tooManyRequest, isSignupButtonDisabled } = useSubmitButtonState(failedFlash, form)

const timer = ref(59)
let intervalId = -1

const resetTimer = computed(
    () => 
    {

        if (timer.value == 0) {
            clearInterval(intervalId)
            return true
        }
        return false
    },
)


const login = () => form.post(route('login.store'))
</script>

<style scoped>  
.afterValidate {
  display: v-bind(display);
}
.validated {
    color: green;
}
</style>