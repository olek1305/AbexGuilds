<template>
    <AppLayout title="Stats">
        <div>
            <Box class="text grid justify-center text-center mb-2">
                Listy do wyboru sezon
                <div class="grid justify-center mb-2">

                <select v-model="form.selectedSeason" class="input w-48 mx-auto">
                    <option :value="null" hidden>Sezon</option>
                    <option v-for="season in sortedSeasons" :key="season" :value="season">
                        {{ season }}
                    </option>
                </select>

                <button class="btn mx-auto" @click="submit">Zastosuj</button>

                </div>
                <div v-if="guilds.length > 0">
                    <table class="table-auto text-2xl w-full text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-sm text-center">
                                <th class="w-32">Gildia</th>
                                <th class="w-32">Total dmg</th>
                                <th class="w-32">Players</th>
                                <th class="w-32">Stars</th>
                                <th class="w-32">Observer</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(guild, index) in filteredGuilds" :key="guild.guild_id"
                            class="text-center hover:border-1 hover:border-sky-700">
                            <td :class="colorColumn(index)">{{ guild.name }}</td>
                                <td :class="colorColumn(index)">{{ guild.total_damage }}</td>
                                <td :class="colorColumn(index)">{{ guild.player_count }}</td>
                                <td :class="colorColumn(index)">{{ guild.player_stars }}</td>
                                <td :class="colorColumn(index)">{{ guild.player_observer }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else-if="guilds.length === 0">
                    Brak gildii dla wybranego sezonu
                </div>
                <div v-else>
                    Error
                </div>
            </Box>

            <Box class="text">
                <p class="text-center">General statistics</p>
                <div class=" flex justify-center">
                    <table class="table-auto text">
                        <thead class=" text uppercase bg-gray-50 dark:bg-gray-700 ">
                            <tr class="text-2xl text-center">
                                <td :class="colorColumn(1)" class="w-24">Users</td>
                                <td :class="colorColumn(0)" class="w-24">{{ totalUsers }}</td>
                            </tr>
                            <tr class="text-2xl text-center">
                                <td :class="colorColumn(1)" class="w-24">Notatnik</td>
                                <td :class="colorColumn(0)" class="w-24">{{ totalNotes }}</td>
                            </tr>
                            <tr class="text-2xl text-center">
                                <td :class="colorColumn(1)" class="w-24">Kick</td>
                                <td :class="colorColumn(0)" class="w-24">{{ totalKick }}</td>
                            </tr>
                            <tr class="text-2xl text-center">
                                <td :class="colorColumn(1)" class="w-24">Ban</td>
                                <td :class="colorColumn(0)" class="w-24">{{ totalBan }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </Box>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from "vue";
import { route } from "ziggy-js";

const props = defineProps({
    seasons: Array,
    guilds: Array,
    totalNotes: Number,
    totalUsers: Number,
    totalKick: Number,
    totalBan: Number,
    selectedSeason: Number,
    columnIndex: Number
});

const form = useForm({
    selectedSeason: props.selectedSeason
})
const submit = () => {
    form.get(route('stats.index', { season: form.selectedSeason }));
}

const filteredGuilds = computed(() => {
    return props.guilds.filter(guild =>  guild.players.some(player => player.season === form.selectedSeason));
});

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal border-b-2 border-gray-800'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal border-b-2 border-gray-800';

const sortedSeasons = computed(() => {
    return props.seasons.slice().sort((a, b) => a - b);
});

</script>
