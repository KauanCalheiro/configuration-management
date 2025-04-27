<script setup lang="ts">

async function onLogout() {
    try {
        await useSanctumAuth().logout();
        toast().success({
            description: "Logout efetuado com sucesso"
        });
    } catch {
        toast().error({
            description: "Erro ao efetuar logout"
        });
    }
}
</script>

<template>
    <UButton
        icon="material-symbols:logout-rounded"
        size="xl"
        color="neutral"
        variant="soft"
        @click="onLogout"
    />
</template>
