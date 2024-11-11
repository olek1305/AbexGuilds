<template>
    <AppLayout title="Index excel">
        <Warning />
        <div v-if="sheetID">
            <!-- Reading from Excel for rendering on the web -->
            <ReadExcelToWeb />
            <!-- Copy Users from database for rendering on the excel -->
            <DatabaseUsersToExcel />
            <!-- Copy Players from database for rendering on the excel -->
            <DatabasePlayersToExcel />
            <!-- Copying users from Excel to save in the database -->
            <ExcelUsersToDatabase />
            <!-- Copies data from excel to database -->
            <ExcelSaveToDatabase />
        </div>
        <div v-else class="text">
            <p>Prosze ustawic w configu .env, jest podane linka youtube jak ustawic</p>
            <p>You should set in config .env, there is a youtube link given in .env.example how to set up</p>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ExcelUsersToDatabase from "@/Pages/Excel/Components/ExcelUsersToDatabase.vue";
import DatabaseUsersToExcel from "@/Pages/Excel/Components/DatabaseUsersToExcel.vue";
import ReadExcelToWeb from "@/Pages/Excel/Components/ReadExcelToWeb.vue";
import ExcelSaveToDatabase from "@/Pages/Excel/Components/ExcelSaveToDatabase.vue";
import Warning from "@/Pages/Excel/Components/Warning.vue";
import DatabasePlayersToExcel from "@/Pages/Excel/Components/DatabasePlayersToExcel.vue";




const props = defineProps({
    sheetID: String,
})
</script>
