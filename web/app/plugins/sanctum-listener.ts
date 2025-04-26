export default defineNuxtPlugin((nuxtApp) => {
    const lastSanctumError = ref<any>(null)

    nuxtApp.provide('lastSanctumError', lastSanctumError)

    nuxtApp.hook('sanctum:error', (response) => {
        console.log('Sanctum error hook triggered', response)
        lastSanctumError.value = response
    })
})