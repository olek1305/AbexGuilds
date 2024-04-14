<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie użytkowników z bazy danych do renderowania w Excelu</p>
        <div class="grid justify-center">
            <input v-model="sheetNameSend" type="text" placeholder="Nazwa sheet">
            <button @click="sendSheetName" :disabled="!sheetNameSend" class="text p-2 btn">Wyślij</button>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { ref } from "vue";
import { route } from "ziggy-js";
import { useForm } from "@inertiajs/vue3";

const sheetNameSend = ref('');

const form = useForm({})

const sendSheetName = () => {
    form.post(route('excel.store'), {sheetName: sheetNameSend.value});
};
</script>
