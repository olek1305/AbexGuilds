<template>
    <div v-if="showModal" @click="handleBackgroundClick" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-55">
        <div class="bg-white p-4 rounded shadow-md dark:bg-gray-800">
            <div v-if="!showConfirmation">
                <h2 class="text-lg font-bold mb-2 dark:text-white">Gracz: {{ props.user.name }}</h2>
                <button type="button" class="bg-blue-500 hover:bg-gray-300 textbtn" @click="editPlayer(props.user)">Edit</button>
                <button type="button" class="bg-red-500 hover:bg-gray-300 textbtn" @click="showConfirmation = true">Delete</button>
                <button type="button" class="bg-gray-500 hover:bg-gray-300 textbtn" @click="closeModal">Close</button>
            </div>
            <div v-else>
                <transition name="confirmation">
                    <div>
                        <h2 class="text-lg font-bold mb-2 dark:text-white">Are you sure?</h2>
                        <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="kickUser(props.user)">Yes</button>
                        <button class="bg-blue-500 hover:bg-gray-300 textbtn" @click="showConfirmation = false">No</button>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { ref } from 'vue';

const props = defineProps({
    user: Object,
    showModal: Boolean,
    columnIndex: Number

});

const emit = defineEmits(['close']);
let showConfirmation = ref(false);

const editPlayer = (user) => {
    router.get(route('admin.user.edit', { user: user.id }));
}

const kickUser = (user) => {
    router.delete(route('admin.user.destroy', { user: user.id, action: "kick" }));
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
