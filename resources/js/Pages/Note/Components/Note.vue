<template>
    <div class="grid">
        <Box v-if="note.user" class="md:min-h-48">
            <p class="text">ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
            <div class="text font-bold">User: {{ note.user.name }} </div>
            <p class="text">Powód: {{ props.note.title }}</p>
            <p class="text" v-html="props.note.body"></p>
            <p class="text-sm dark:text-white">By: {{ props.note.signature }}</p>
            <div class="flex justify-center">
                <Link class="btn ml-2 flex-grow hover:bg-gray-300 text-center" :href="route('note.edit', { note: props.note.id })">Edit</Link>
                <button class="btn ml-2 flex-grow hover:bg-gray-300 text-center" @click.stop="selectedNote = props.note.id; showModal = true">Delete</button>
            </div>
            <NoteDeleteModal :note="note" :key="note.id" :show-modal="showModal" @close="showModal = false"/>
        </Box>

        <Box v-else class="grid border-red-600 border-2 stripes">
            <p class="text">ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
            <p class="text-red-600 font-bold">Użytkownik usunięty</p>
            <p class="text">Powód: {{ props.note.title }}</p>
            <p class="text" v-html="props.note.body"></p>
            <p class="text-sm dark:text-white">By: {{ props.note.signature }}</p>
        </Box>
    </div>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import NoteDeleteModal from "@/Pages/Note/Components/NoteDeleteModal.vue";

const props = defineProps({
    note: Object,
})

let showModal = ref(false);
let selectedNote = ref(false);

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
