<template>
    <Box class="grid">
        <p class="text">Notatnik: ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
        <p class="text" v-if="props.note.user">Gracz: {{ props.note.user.name }}</p>
        <p class="text">Powód: {{ props.note.title }}</p>
        <p class="text">{{ props.note.body }}</p>
        <div class="flex justify-center">
            <Link class="btn ml-2 flex-grow hover:bg-gray-300 text-center" :href="route('note.edit', { note: props.note.id })">Edit</Link>
            <a class="btn ml-2 flex-grow hover:bg-gray-300 text-center cursor-pointer" @click="deleteNote">Delete</a>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { Link } from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    note: Object,
})

const shortCutData = (data) => {
    if (!data) return '';
    return data.split('T')[0];
};

const deleteNote = () => {
    if (confirm('Czy na pewno chcesz usunąć tę notatkę?')) {
        Inertia.delete(route('note.destroy', { note: props.note.id }));
    }
};

</script>
