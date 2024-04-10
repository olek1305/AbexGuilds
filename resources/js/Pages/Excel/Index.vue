<template>
    <AppLayout>
        <div v-if="sheetID">
            <Box class="flex justify-center text-center mb-2">
                <div>
                    <p class="title pb-2">Odczytywac od Excel na web</p>
                    <div class="grid justify-center">
                        <input v-model="sheetNameLoad" type="text" placeholder="Nazwa sheet">
                        <button @click="loadSheetName(sheetNameLoad)" class="text p-2 btn">Wyslij</button>
                    </div>
                </div>
            </Box>
            <Box class="mx-auto text-center">
                <p class="title pb-2">Kopiowanie z bazy danych do Google Excel</p>
                <div class="grid justify-center">
                    <input v-model="sheetNameSend" type="text" placeholder="Nazwa sheet">
                    <button @click="sendSheetName" class="text p-2 btn">Wyślij</button>
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
import { ref } from "vue";
import { route } from "ziggy-js";

const props = defineProps({
    sheetID: String,
    IdSeason: Boolean
})

const sheetNameLoad = ref('');
const sheetNameSend = ref('');

const sendSheetName = () => {
    Inertia.post(route('excel.store'), {sheetName: sheetNameSend.value});
};

const loadSheetName = (sheetName) => {
    Inertia.get(route('excel.show', {sheetName: sheetName}));
}
</script>
