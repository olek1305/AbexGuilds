<template>
    <Box class="grid">
        <p>Notatnik: ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
        <p class="font-semibold" v-if="props.note.user">Gracz: {{ props.note.user.name }}</p>
        <p class="font-semibold">Powód: {{ props.note.title }}</p>
        <p class="font-semibold">{{ props.note.body }}</p>
        <div class="flex justify-center">
            <button class="btn ml-2 flex-grow hover:bg-yellow-400" @click="editNote">Edit</button>
            <button class="btn ml-2 flex-grow hover:bg-red-600" @click="deleteNote">Delete</button>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Pages/Components/UI/Box.vue";

const props = defineProps({
    note: Object
})

const shortCutData = (data) => {
    if (!data) return '';
    return data.split('T')[0];
};

const editNote = () => {

}

const deleteNote = () => {

}
</script>
