<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 dark:text-white">
                    <div>
                        <div class="">
                            <div class="relative overflow-x-auto">
                                <table class="table-auto text-2xl w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr class="text-xl">
                                        <th>Username</th>
                                        <th>Damage</th>
                                        <th>Czy jest obserwatorem?</th>
                                        <th>Czy jest Gwiazda?</th>
                                        <th>Gildia</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <Player v-for="player in players" :key="player.id" :player="player"/>
                                    </tbody>
                                </table>
                            </div>
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

defineProps({
    players: Array
})
</script>
