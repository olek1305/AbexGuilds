<template>
    <Box class="grid">
        <p>Notatnik: ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
        <p class="font-semibold" v-if="props.note.user">Gracz: {{ props.note.user.name }}</p>
        <p class="font-semibold">Powód: {{ props.note.title }}</p>
        <p class="font-semibold">{{ props.note.body }}</p>
        <div class="flex justify-center">
            <Link class="btn ml-2 flex-grow hover:bg-yellow-400 text-center" :href="route('note.edit', { note: props.note.id })">Edit</Link>
            <a class="btn ml-2 flex-grow hover:bg-red-600 text-center" @click.prevent="deleteNote">Delete</a>
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
