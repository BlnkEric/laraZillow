import { computed } from 'vue'
export const useSubmitButtonState = (form) => {
    
    const isSignupButtonDisabled = computed(() => {
        let disabled = false
        if (!form.email || !form.password) {
            disabled = true
        }
        return disabled
    })

    return { isSignupButtonDisabled }
}