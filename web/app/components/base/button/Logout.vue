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
    // const response = await $fetch("/api/logout", {
    //     method: "POST",
    //     body: JSON.stringify({ id: useAuth().user()?.id }),
    // });

    // if (response.success) {
    //     useNotification.success("Logout efetuado com sucesso");
    //     useAuth().logout();
    //     useRouter().push("/login");
    // }
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
