<template>
    <AppLayout>
        <h2 class="text text-center">Notatnik użytkownika: {{ user.name }}</h2>
        <div class="grid gap-4 sizeSmall sizeBig">
            <Note
                v-for="note in notes.data"
                :key="note.id" :note="note"
            />
        </div>
        <div v-if="notes.data.length" class="w-full flex justify-center mt-4 mb-4 text">
            <Pagination :links="notes.links"/>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Note from "@/Pages/Note/Components/Note.vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";

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

