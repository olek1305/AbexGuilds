<template>
    <AppLayout title="Index notes">
        <div class="flex justify-center m-1">
            <Link class="flex btn justify-center w-52" :href="route('note.create')">Utwórz Notatnik</Link>
        </div>
        <p class="title text-center mb-1 border-t-2 border-l-2 border-r-2 border-sky-500">Niedawno notatnik</p>
        <div class="grid gap-4 sizeSmall sizeBig">
            <Note
                v-for="note in notes.data"
                :key="note.id" :note="note"
            />
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
import { Link, router } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps({
    notes: Object,
    users: Object
})

const notePlayer = (player) => {
    router.get(route('note.show', { note: player.user.id }));
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
