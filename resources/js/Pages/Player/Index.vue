<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 dark:text-white">
                    <div>
                        <div class="overflow-x-auto">
                            <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="text-xl">
                                    <th
                                        v-for="(column, index) in columns" :key="index">{{ column }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <Player v-for="(player, index) in players" :key="player.id" :player="player" :columnIndex="index"/>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Player from "@/Pages/Player/Components/Player.vue";

const columns = ['Username', 'Damage', 'Czy jest obserwatorem?', 'Czy jest Gwiazda?', 'Gildia', 'Edit', 'Delete'];

defineProps({
    players: Array
})
</script>
