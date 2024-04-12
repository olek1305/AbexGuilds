<template>
    <AppLayout title="Index excel">
        <div v-if="sheetID">
            <!-- Reading from Excel for rendering on the web -->
            <ReadExcelToWeb />
            <!-- Copy Users from database for rendering on the excel -->
            <DatabaseToExcel />
            <!-- Copying users from Excel to save in the database -->
            <ExcelToDatabase />
        </div>
        <div v-else class="text">
            Prosze ustawic w configu .env, jest podane linka youtube jak ustawic
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ExcelToDatabase from "@/Pages/Excel/Components/ExcelToDatabase.vue";
import DatabaseToExcel from "@/Pages/Excel/Components/DatabaseToExcel.vue";
import ReadExcelToWeb from "@/Pages/Excel/Components/ReadExcelToWeb.vue";

const props = defineProps({
    sheetID: String,
})
</script>
