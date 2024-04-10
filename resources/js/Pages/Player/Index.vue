<template>
    <AppLayout title="Players">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <Box class="rounded-b-none">
                <div v-if="isAdminUser" class="flex justify-center m-1">
                    <Link class="flex btn justify-center w-52" :href="route('player.create')">Utwórz gracza</Link>
                </div>

                <PlayerFilters :filters="filters" :guilds="guilds" :seasons="seasons"/>
            </Box>
            <div class="overflow-x-auto">
                <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                    <tr class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th class="text-center" v-for="(column, index) in columns" :key="index">
                            {{ column }}
                        </th>
                    </tr>
                        <Player
                            v-for="(player, index) in players.data"
                            :key="player.id"
                            :player="player"
                            :columnIndex="index"
                            :guilds="guilds"
                        />
                </table>
            </div>
        </div>
        <div v-if="players.data.length" class="w-full flex justify-center mt-4 mb-4 dark:text-gray-400">
            <Pagination :links="players.links"/>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Player from "@/Pages/Player/Components/Player.vue";
import PlayerFilters from "@/Pages/Player/Components/PlayerFilters.vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";
import {route} from "ziggy-js";
import {Link} from "@inertiajs/vue3";
import Box from "@/Pages/Components/UI/Box.vue";

const columns = ['Username', 'Damage', 'Gwiazda?', 'Obser?', 'Gildia', 'Akcje'];

const props = defineProps({
    players: Object,
    filters: Object,
    guilds: Object,
    seasons: Object,
    isAdminUser: Object
})

</script>

<style>
    th {
        min-width: 130px; /* Minimalna szerokość kolumny */
    }
</style>
