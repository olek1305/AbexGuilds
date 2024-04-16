<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie dane z Excela w celu zapisania w bazie danych (Player i inne dane)</p>
        <p class="text-rose-300">UWAGA: MUSI BYC DOKLADNIE NAZW KOLUMNY W EXCELU TAKI JAK PONIZEJ:</p>
        <p class="text-rose-300">WARNING: MUST BE EXACTLY THE COLUMN NAME IN EXCEL LIKE AS BELOW:</p>
        <p class="text">| user_name | damage | guild | is_observer | is_star | season |</p>
        <form @submit.prevent="submit">
            <input v-model="form.sheetName" type="text" placeholder="Nazwa sheet">
            <button type="submit" class="text p-2 btn">Wyślij</button>
        </form>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    sheetName: null
})

const submit = () => {
    form.post(route('excel.store.database', { sheetName: form.sheetName }));
}
</script>
