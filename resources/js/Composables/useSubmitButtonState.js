import { computed, ref } from 'vue'
export const useSubmitButtonState = (flashMassages, form) => {
    
    
    const tooManyRequest = computed(() => {
        let disabled = false
        if (flashMassages.value) {
            disabled = true
        }
        return disabled
    })

    const isSignupButtonDisabled = computed(() => {
        let disabled = false
        if (!form.email || !form.password) {
            disabled = true
        }
        return disabled
    })

    return { tooManyRequest, isSignupButtonDisabled }
}