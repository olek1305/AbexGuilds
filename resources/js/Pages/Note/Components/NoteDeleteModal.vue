<template>
    <div v-if="showModal" @click="handleBackgroundClick" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-55">
        <div class="bg-white p-4 rounded shadow-md dark:bg-gray-800">
            <Box>
                <p class="title text-center"> ID: {{ form.note_id }}</p>
                <p class="text text-center">Are you sure?</p>
                <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="deleteNote">Delete</button>
                <button class="bg-blue-500 hover:bg-gray-300 textbtn" @click="closeModal">Cancel</button>
            </Box>
        </div>
    </div>
</template>

<script setup>
import { route } from "ziggy-js";
import Box from "@/Pages/Components/UI/Box.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    note: Object,
    showModal: Boolean,
});

const form = useForm({
    note_id: props.note.id,
});

const emit = defineEmits(['close']);

const deleteNote = () => {
    form.delete(route('note.destroy', { note: form.note_id }));
    emit('close');
}

const closeModal = () => {
    emit('close');
}

const handleBackgroundClick = (event) => {
    if (event.target === event.currentTarget) {
        closeModal();
    }
}

</script>

<style scoped>
.textbtn {
    @apply text-white font-medium px-4 py-2 rounded m-1
}
</style>
