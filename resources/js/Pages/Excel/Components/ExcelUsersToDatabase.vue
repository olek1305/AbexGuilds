<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie użytkowników z Excela w celu zapisania w bazie danych (tylko Users, nie Player)</p>
        <form @submit.prevent="submit">
            <input v-model="form.columnName" type="text" placeholder="Nazwa kolumna">
            <input v-model="form.sheetName" type="text" placeholder="Nazwa sheet">
            <button type="submit" class="text p-2 btn">Wyślij</button>
        </form>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { ref } from "vue";
import { route } from "ziggy-js";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    sheetName: null,
    columnName: null
})

const submit = (columnName, sheetName) => {
    form.post(route('excel.store.users', {columnName: form.columnName, sheetName: form.sheetName }))
}
</script>
