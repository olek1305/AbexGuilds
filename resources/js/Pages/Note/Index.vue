<template>
    <AppLayout>
        <p class="dark:text-white text-center">Niedawno notatnik</p>
        <div class="grid grid-cols-2 gap-4">
            <Note
                v-for="note in notes.data"
                :key="note.id" :note="note"
            />
        </div>
        <div v-if="notes.data.length" class="w-full flex justify-center mt-4 mb-4 dark:text-gray-400">
            <Pagination :links="notes.links"/>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Note from "@/Pages/Note/Components/Note.vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";

const props = defineProps({
    notes: Object,
})

</script>
