<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie użytkowników z Excela w celu zapisania w bazie danych</p>
        <div>
            <input v-model="columnName" type="text" placeholder="Nazwa kolumna">
            <input v-model="sheetNameForColumn" type="text" placeholder="Nazwa sheet">
            <button @click="sendColumnName" class="text p-2 btn">Wyślij</button>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { ref } from "vue";
import { route } from "ziggy-js";
import {useForm} from "@inertiajs/vue3";

const sheetNameForColumn = ref('');
const columnName = ref('');

const form = useForm({})

const sendColumnName = (columnName, sheetName) => {
    form.post(route('excel.store', {columnName: columnName.value, sheetName: sheetNameForColumn.value}))
}
</script>
