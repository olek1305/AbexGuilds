<template>
    <AppLayout>
        <h2 class="title text-center">Notatnik użytkownika: {{ user.name }}</h2>
        <div v-if="notes.data.length > 0" class="grid gap-4 sizeSmall sizeBig">
            <Note
                v-for="note in notes.data"
                :key="note.id" :note="note"
            />
        </div>

        <div v-else class="text-center p-5 text grid justify-center">
            <p class="p-3">Ten użytkownik nie posiada notatek. Stwórz notatkę!</p>
            <div>
                <Link class="btn" as="button" type="button" :href="route('note.create')">Home</Link>
            </div>
        </div>
        <div v-if="notes.data.length" class="w-full flex justify-center mt-4 mb-4 title">
            <Pagination :links="notes.links"/>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Note from "@/Pages/Note/Components/Note.vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";
import { Link } from '@inertiajs/vue3'
import { route } from "ziggy-js";

const props = defineProps({
    user: Object,
    notes: Object,
});

</script>

<style scoped>
.sizeSmall{
    @apply sm:grid-cols-1
}

.sizeBig{
    @apply lg:grid-cols-2
}
</style>

