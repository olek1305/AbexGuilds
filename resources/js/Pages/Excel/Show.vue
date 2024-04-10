<template>
    <AppLayout title="Show excel">
        <Box class="mx-auto text-center overflow-x-auto">
            <p class="text">ONLY READ</p>
            <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                <tr class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <td v-for="(column, index) in columns" :key="column" class="text-center">
                        {{ column }}
                    </td>
                </tr>
                <tr class="table-auto text-2xl text-center " v-for="(sheet, index) in sheets" :key="sheet.id">
                    <td :class="colorColumn(index)">{{ sheet.Lp }}</td>
                    <td></td>
                    <td :class="colorColumn(index)">{{ sheet.ID }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Nick }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Wynik }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Gildia }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Gwiazda }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Obs }}</td>
                    <td :class="colorColumn(index)">{{ sheet.Debuff }}</td>
                </tr>
            </table>
        </Box>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
const props = defineProps({
    sheets: Array,
    columnIndex: Number
})

const columns = ['LP', '',  'ID', 'NICK', 'Wynik?', 'Gildia', 'Gwiazda', 'Obs', 'Debuff'];

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal border-b-2 border-gray-800'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal border-b-2 border-gray-800';
</script>

