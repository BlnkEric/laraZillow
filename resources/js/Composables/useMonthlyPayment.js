import { computed, isRef } from 'vue'

export const useMonthlyPayment = (total, interestRate, duration) => {

    const computedTotal = computed(() => {
        return isRef(total) ? total.value : total
    })
    const computedInterestRate = computed(() => {
        return (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
    })
    const computedDuration = computed(() => {
        return (isRef(duration) ? duration.value : duration) * 12
    })
    const monthlyPayment = computed(() => {
        const principle = computedTotal.value
        const monthlyInterest = computedInterestRate.value
        const numberOfPaymentMonths = computedDuration.value

        return  principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })
    const totalPaid = computed(() => {
        return computedDuration.value * monthlyPayment.value
    })
    const totalInterest = computed(() => {
        return totalPaid.value - computedTotal.value
    })

    return { monthlyPayment, totalPaid, totalInterest }
}