<template>
    <Box class="mx-auto text-center mb-2">
        <p class="title pb-2">Kopiowanie users z bazy danych do renderowania w Excelu</p>
        <form @submit.prevent="submit" class="grid justify-center">
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
    sheetName: null,
})

const submit = () => {
    form.post(route('excel.store', { sheetName: form.sheetName }));
};
</script>
