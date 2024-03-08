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
                <div class="btn" @click="routeToGuild">
                    <span class="p-1">Utwórz Guild</span>
                </div>
                <div class="btn" @click="routeToUser">
                    <span class="p-1">Utwórz User</span>
                </div>
            </Box>
            <Box class="text flex justify-center m-2 text-center ">
                <p class="text-center">W trakcie dev</p>
                <div class="btn text-lg">
                    <span class="p-1 cursor-not-allowed">zmiana nicku gracza</span>
                </div>
                <div class="btn text-lg">
                    <span class="p-1 cursor-not-allowed">zmiana hasła gracza</span>
                </div>
                <div class="btn text-lg">
                    <span class="p-1 cursor-not-allowed">Przywracanie user</span>
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

const routeToGuild = () => {
    window.location.href = route('admin.guild.create');
};
const routeToUser = () => {
    window.location.href = route('admin.user.create');
};
</script>
