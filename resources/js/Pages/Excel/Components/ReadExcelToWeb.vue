<template>
    <Box class="flex justify-center text-center mb-2">
        <div>
            <p class="title pb-2">Odczyt z Excela do renderowania w sieci</p>
            <div class="grid justify-center">
                <input v-model="sheetNameLoad" type="text" placeholder="Nazwa sheet">
                <button @click="loadSheetName(sheetNameLoad)" :disabled="!sheetNameLoad" class="text p-2 btn">Wyslij</button>
            </div>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { route } from "ziggy-js";
import {useForm} from "@inertiajs/vue3";

const sheetNameLoad = ref('');

const form = useForm({})

const loadSheetName = (sheetName) => {
    form.get(route('excel.show', {sheetName: sheetName}));
}
</script>
