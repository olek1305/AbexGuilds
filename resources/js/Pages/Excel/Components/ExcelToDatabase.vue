<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Pobiera użytkowników i wysyła do bazy danych</p>
        <div>
            <input v-model="columnName" type="text" placeholder="Nazwa kolumna">
            <input v-model="sheetNameForColumn" type="text" placeholder="Nazwa sheet">
            <button @click="sendColumnName" class="text p-2 btn">Wyślij</button>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {route} from "ziggy-js";

const sheetNameForColumn = ref('');
const columnName = ref('');

const sendColumnName = (columnName, sheetName) => {
    Inertia.post(route('excel.store', {columnName: columnName.value, sheetName: sheetNameForColumn.value}))
}
</script>
