import { computed } from 'vue'

export const useValidationPass = (form) => {

    const validationPass = computed(() => {
        if (!form.hasErrors){
            return 'fa-solid fa-spinner'
        }else{
            return 'fa-solid fa-check-circle'
        }
    })

    return { validationPass }

}