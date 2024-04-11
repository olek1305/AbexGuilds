<template>
    <AppLayout title="Index excel">
        <div v-if="sheetID">
            <Box class="flex justify-center text-center mb-2">
                <div>
                    <p class="title pb-2">Odczytywac z Excela na web</p>
                    <div class="grid justify-center">
                        <input v-model="sheetNameLoad" type="text" placeholder="Nazwa sheet">
                        <button @click="loadSheetName(sheetNameLoad)" class="text p-2 btn">Wyslij</button>
                    </div>
                </div>
            </Box>
            <Box class="mx-auto text-center mb-2">
                <p class="title pb-2">Kopiowanie z bazy danych do Google Excel</p>
                <div class="grid justify-center">
                    <input v-model="sheetNameSend" type="text" placeholder="Nazwa sheet">
                    <button @click="sendSheetName" class="text p-2 btn">Wyślij</button>
                </div>
            </Box>
            <Box class="mx-auto text-center mb-2">
                <p class="title pb-2">Pobiera użytkowników i wysyła do bazy danych</p>
                <div>
                    <input v-model="columnName" type="text" placeholder="Nazwa kolumna">
                    <input v-model="sheetNameForColumn" type="text" placeholder="Nazwa sheet">
                    <button @click="sendColumnName" class="text p-2 btn">Wyślij</button>
                </div>
            </Box>
        </div>
        <div v-else class="text">
            Prosze ustawic w configu .env, jest podane linka youtube jak ustawic
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { Inertia } from "@inertiajs/inertia";
import {ref, watch} from "vue";
import { route } from "ziggy-js";

const props = defineProps({
    sheetID: String,
    IdSeason: Boolean
})

const sheetNameLoad = ref('');
const sheetNameSend = ref('');
const sheetNameForColumn = ref('');
const columnName = ref('');

const sendSheetName = () => {
    Inertia.post(route('excel.store'), {sheetName: sheetNameSend.value});
};

const loadSheetName = (sheetName) => {
    Inertia.get(route('excel.show', {sheetName: sheetName}));
}

const sendColumnName = (columnName, sheetName) => {
    Inertia.post(route('excel.store', {columnName: columnName.value, sheetName: sheetNameForColumn.value}))
}

watch(sheetNameForColumn, () => sendColumnName());
watch(columnName, () => sendColumnName());
</script>
