<template>
    <AppLayout>
        <div>
            <Box class="text grid grid-rows-5 grid-flow-col m-2 text-center">
                <p>Sezon: {{ latestSeasonId }}</p>
                <div v-for="guild in guilds" :key="guild.id">
                    <p class="p-2">{{ guild.name }} - {{ guild.players_count }}</p>
                </div>
            </Box>
            <Box class="text flex justify-center m-2 text-center ">
                <div class="buttonDiv">
                    <p class="p-1">Utwórz Guild</p>
                </div>
                <div class="buttonDiv">
                    <p class="p-1">Utwórz User</p>
                </div>
            </Box>
            <Box class="text flex justify-center m-2 text-center ">
                <div class="buttonDiv text-lg ">
                    <p class="p-1">zmiana nicku gracza</p>
                </div>
                <div class="buttonDiv text-lg">
                    <p class="p-1">zmiana hasła gracza</p>
                </div>
                <div class="buttonDiv text-lg">
                    <p class="p-1">Przywracanie user</p>
                </div>
            </Box>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";

const props = defineProps({
    guilds: Array,
    latestSeasonId: Number
})
</script>

<style scoped>

.buttonDiv{
    @apply border-2 m-1
}

</style>
