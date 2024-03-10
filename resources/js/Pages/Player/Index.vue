<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 dark:text-white pt-2">
                    <div class="flex justify-center mb-2">
                        <Link class="flex btn justify-center" :href="route('player.create')">Utwórz gracza</Link>
                    </div>
                    <hr>
                    <PlayerFilters :filters="filters" :guilds="guilds" :seasons="seasons"/>
                    <div class="overflow-x-auto">
                        <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-xl">
                                <th class="text-center" v-for="(column, index) in columns" :key="index">
                                    {{ column }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <Player
                                    v-for="(player, index) in players.data"
                                    :key="player.id" :player="player"
                                    :columnIndex="index"
                                />
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-if="players.data.length" class="w-full flex justify-center mt-4 mb-4 dark:text-gray-400">
                    <Pagination :links="players.links"/>
                </div>
            </div>
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

const columns = ['Username', 'Damage', 'Gwiazda?', 'Obser?', 'Gildia', 'Edit'];

const props = defineProps({
    players: Object,
    filters: Object,
    guilds: Object,
    seasons: Object
})
</script>

<style>
    th {
        min-width: 130px; /* Minimalna szerokość kolumny */
    }
</style>
