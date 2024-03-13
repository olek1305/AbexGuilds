<template>
    <AppLayout>
        <div>
            <Box class="text grid grid-rows-5 grid-flow-col m-2 text-center">
                <p class="col-span-5">Sezon: {{ latestSeasonId }}</p>
                <div v-for="guild in guilds" :key="guild.id">
                    <p class="p-2">{{ guild.name }} - {{ guild.players_count }}</p>
                </div>
            </Box>
            <Box class="text flex justify-center m-2 text-center ">
                <div class="btn">
                    <a class="p-1" :href="route('admin.guild.create')">Utwórz Guild</a>
                </div>
                <div class="btn">
                    <a class="p-1" :href="route('admin.user.create')">Utwórz User</a>
                </div>
            </Box>
            <Box class="text flex justify-center m-2 text-center ">
                <div class="btn text-lg">
                    <a :href="route('admin.user.list')">Lista użytkowników</a>
                </div>
                <div class="btn text-lg">
                   <a :href="route('admin.user.restoreIndex')">Przywróć użytkownika</a>
                </div>
            </Box>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import {route} from "ziggy-js";

const props = defineProps({
    guilds: Array,
    latestSeasonId: Number
})

</script>
