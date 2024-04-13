<template>
    <AppLayout title="Activity - Index">
        <Box class="mx-auto w-52 grid justify-center mb-4">
            <form @submit.prevent="filter" class="grid justify-center">
                <select v-model.number="filterForm.guild_id" class="input w-48 mx-auto">
                    <option :value="null" hidden>Nazwa Gildia</option>
                    <option v-for="(guild, index) in guilds" :key="index.id" :value="guild.id">{{ guild.name }}</option>
                </select>
                <div>
                    <button type="submit" class="grid btn justify-center w-48">Filter</button>
                </div>
            </form>
        </Box>
        <Box class="mx-auto w-52 grid justify-center mb-4">
            <p class="text-rose-600 text-center">WARNING</p>
            <p class="text text-center">IS THE LATEST SEASON OF PLAYERS</p>
        </Box>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    guilds: Object,
});

const filterForm = useForm({
    guild_id: null
});

let filterTimeout = null;

const filter = () => {
    clearTimeout(filterTimeout);
    filterTimeout = setTimeout(() => {
        filterForm.get(route('activity.show', { activity: filterForm.guild_id }), {
            onSuccess: () => { console.log('Request successful') },
            onError: () => { console.log('Request error') },
        });
    }, 1000);
};
</script>
