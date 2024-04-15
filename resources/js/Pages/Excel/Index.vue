<template>
    <AppLayout title="Index excel">
        <Warning />
        <div v-if="sheetID">
            <!-- Reading from Excel for rendering on the web -->
            <ReadExcelToWeb />
            <!-- Copy Users from database for rendering on the excel -->
            <DatabaseToExcel />
            <!-- Copying users from Excel to save in the database -->
            <ExcelUsersToDatabase />
            <!-- Copies data from excel to database -->
            <ExcelSaveToDatabase />
        </div>
        <div v-else class="text">
            Prosze ustawic w configu .env, jest podane linka youtube jak ustawic
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ExcelUsersToDatabase from "@/Pages/Excel/Components/ExcelUsersToDatabase.vue";
import DatabaseToExcel from "@/Pages/Excel/Components/DatabaseToExcel.vue";
import ReadExcelToWeb from "@/Pages/Excel/Components/ReadExcelToWeb.vue";
import ExcelSaveToDatabase from "@/Pages/Excel/Components/ExcelSaveToDatabase.vue";
import Warning from "@/Pages/Excel/Components/Warning.vue";




const props = defineProps({
    sheetID: String,
})
</script>
