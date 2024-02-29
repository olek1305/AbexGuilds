<template>
    <AppLayout>
        <p class="dark:text-white text-center">Niedawno notatnik</p>
        <div class="grid grid-cols-2 gap-4">
            <div v-for="note in notes" :key="note.id" class="dark:text-white border-2 border-sky-500 p-1">
                <p>Notatnik: ID {{ note.id }}: {{ shortCutData(note.created_at) }}</p>
                <p>Gracz: {{ note.user.name }}, </p>
                <p>Powód: {{ note.title }} </p>
                <div class="flex justify-end">
                    <p>Edit</p>
                    <p>Delete</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    notes: Array
})

const shortCutData = (data) => {
    if (!data) return '';
    return data.split('T')[0];
};

</script>
