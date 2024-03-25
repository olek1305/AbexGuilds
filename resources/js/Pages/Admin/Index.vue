<template>
    <AppLayout>
        <div>
            <Box class="title grid grid-rows-5 grid-flow-col m-2 text-center text">
                <p class="col-span-5">Sezon: {{ latestSeasonId }}</p>
                <div v-for="guild in guilds" :key="guild.id">
                    <p class="p-2">{{ guild.name }} - {{ guild.players_count }}</p>
                </div>
            </Box>
            <Box class="title flex justify-center m-2 text-center ">
                <div class="btn">
                    <Link class="p-1" as="button" type="button" :href="route('admin.guild.create')">Utwórz Guild</Link>
                </div>
                <div class="btn">
                    <Link class="p-1" as="button" type="button" :href="route('admin.user.create')">Utwórz User</Link>
                </div>
            </Box>
            <Box class="title flex justify-center m-2 text-center ">
                <div class="btn">
                    <Link class="p-1" as="button" type="button" :href="route('admin.user.list')">Lista użytkowników</Link>
                </div>
                <div class="btn">
                    <Link class="p-1" as="button" type="button" :href="route('admin.user.restoreIndex')">Przywróć użytkownika</Link>
                </div>
            </Box>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    guilds: Array,
    latestSeasonId: Number
})

</script>
