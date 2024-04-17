<template>
    <AppLayout title="Index notes">
        <div class="flex justify-center mb-2">
            <Link class="flex btn justify-center w-52" :href="route('note.create')">Utwórz Notatnik</Link>
        </div>
        <p class="title text-center mb-1 rounded border-t border-l border-r dark:border-sky-500 border-gray-900">Niedawno notatnik</p>
        <div class="grid gap-4 sizeSmall sizeBig">
            <Note
                v-for="note in notes.data"
                :key="note.id" :note="note"
            />
        </div>
        <div v-if="notes.data.length" class="w-full flex justify-center mt-4 mb-4 dark:text-gray-400">
            <Pagination class="border-b border-gray-900 dark:border-sky-500 title" :links="notes.links"/>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Note from "@/Pages/Note/Components/Note.vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";
import {Link, useForm} from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps({
    notes: Object,
    users: Object
})

const form = useForm({})

const notePlayer = (player) => {
    form.get(route('note.show', { note: player.user.id }));
}

</script>

<style scoped>
.sizeSmall{
    @apply sm:grid-cols-1
}

.sizeBig{
    @apply lg:grid-cols-2
}
</style>
