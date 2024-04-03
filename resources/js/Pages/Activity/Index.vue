<template>
    <AppLayout>
        <Box class="mx-auto w-52 grid justify-center mb-4">
            <form @submit.prevent="filter" class="grid justify-center">
                <select v-model.number="filterForm.guild_id" class="input">
                    <option :value="null" hidden>Nazwa Gildia</option>
                    <option v-for="(guild, index) in guilds" :key="index" :value="guild.id">{{ guild.name }}</option>
                </select>
                <div>
                    <button type="submit" class="grid btn justify-center w-48">Filter</button>
                </div>
            </form>
        </Box>
        <ActivityTable :players="filteredPlayers"/>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ActivityTable from "@/Pages/Activity/Components/ActivityTable.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { computed } from "vue";

const props = defineProps({
    players: Array,
    guilds: Object,
});

const filterForm = useForm({
    guild_id: null,
});

let filterTimeout = null;

const filter = () => {
    clearTimeout(filterTimeout);
    filterTimeout = setTimeout(() => {
        filterForm.get(
            route('activity.index'),
            {
                preserveState: true,
                preserveScroll: true
            },
        );
    }, 1000);
};

const filteredPlayers = computed(() => {
    if (filterForm.guild_id !== null) {
        return props.players.filter(player => player.guild_id === filterForm.guild_id);
    } else {
        return props.players;
    }
});
</script>
