<template>
    <AppLayout title="Show excel">
        <Box class="mx-auto text-center overflow-x-auto">
            <p class="text">ONLY READ</p>
            <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                <tr class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <td v-for="(column, index) in nameColumns" :key="index" class="text-center">
                        {{ column }}
                    </td>
                </tr>
                <tr class="table-auto text-2xl text-center" v-for="(row, rowIndex) in data_sheets" :key="rowIndex">
                    <td v-for="(column, index) in row" :key="index">
                        <p :class="colorColumn(index)">{{ column || '-' }}</p>
                    </td>
                </tr>

            </table>
        </Box>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";

const props = defineProps({
    data_sheets: Array,
    nameColumns: Array,
    columnIndex: Number
});

const colorColumn = (index) => index % 2 === 0
? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal border-b-2 border-gray-800'
: 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal border-b-2 border-gray-800';
</script>

