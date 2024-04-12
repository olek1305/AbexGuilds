<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie z bazy danych do Google Excel</p>
        <div class="grid justify-center">
            <input v-model="sheetNameSend" type="text" placeholder="Nazwa sheet">
            <button @click="sendSheetName" class="text p-2 btn">Wyślij</button>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {route} from "ziggy-js";

const sheetNameSend = ref('');

const sendSheetName = () => {
    Inertia.post(route('excel.store'), {sheetName: sheetNameSend.value});
};
</script>
