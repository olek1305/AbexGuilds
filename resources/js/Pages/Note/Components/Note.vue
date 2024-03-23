<template>
    <div>
        <Box v-if="note.user" class="grid">
            <p class="text">ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
            <div class="text font-bold">User: {{ note.user.name }} </div>
            <p class="text">Powód: {{ props.note.title }}</p>
            <p class="text">{{ props.note.body }}</p>
            <div class="flex justify-center">
                <Link class="btn ml-2 flex-grow hover:bg-gray-300 text-center" :href="route('note.edit', { note: props.note.id })">Edit</Link>
                <a class="btn ml-2 flex-grow hover:bg-gray-300 text-center cursor-pointer" @click="deleteNote">Delete</a>
            </div>
        </Box>

        <Box v-else class="grid border-red-600 border-2 stripes">
            <p class="text">ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
            <p class="text-red-600 font-bold">Użytkownik usunięty</p>
            <p class="text">Powód: {{ props.note.title }}</p>
            <p class="text">{{ props.note.body }}</p>
        </Box>
    </div>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

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
