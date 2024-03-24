<template>
    <div v-if="showModal" @click="handleBackgroundClick" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-55">
        <div class="bg-white p-4 rounded shadow-md dark:bg-gray-800">
            <div v-if="!showConfirmation">
                <div>
                    <h2 class="text-lg font-bold mb-2 text">Gracz: {{ props.player.user.name }}</h2>
                    <button type="button" class="bg-blue-500 hover:bg-gray-300 textbtn" @click="editPlayer(props.player)">Edit</button>
                    <button type="button" class="bg-yellow-600 hover:bg-gray-300 textbtn" @click="notePlayer(props.player)">Note</button>
                    <button type="button" class="bg-red-500 hover:bg-gray-300 textbtn" @click="showConfirmation = true">Delete</button>
                </div>
                <Box>
                    <div>
                        <h2 class="text-lg font-bold text">przeniesienie do innej gildii</h2>
                        <select v-model="selectedGuild">
                            <option v-for="guild in guilds" :key="guild.id" :value="guild">
                                {{ guild.name }}
                            </option>
                        </select>
                        <button class="bg-green-500 hover:bg-gray-300 textbtn" @click="transferPlayer(props.player)">Transfer</button>
                    </div>
                </Box>
                <button type="button" class="bg-gray-500 hover:bg-gray-300 textbtn" @click="closeModal">Close</button>
            </div>
            <div v-else>
                <transition>
                    <div>
                        <h2 class="text-lg font-bold mb-2 dark:text-white">Are you sure?</h2>
                        <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="deletePlayer(props.player)">Yes</button>
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
import Box from "@/Pages/Components/UI/Box.vue";

const props = defineProps({
    player: Object,
    guilds: Array,
    showModal: Boolean,
    columnIndex: Number
});

const emit = defineEmits(['close']);

let showConfirmation = ref(false);
let selectedGuild = null


const editPlayer = (player) => {
    router.get(route('player.edit', { player: player.id }));
}

const notePlayer = (player) => {
    router.get(route('note.show', { note: player.user.id }));
}

const deletePlayer = (player) => {
    router.delete(route('player.destroy', { player: player.id }));
    emit('close');
}

const transferPlayer = (player) => {
    router.patch(route('players.transfer', { player: player.id }), {
        guild_id: selectedGuild.id,
        onSuccess: emit('close'),
        onError: console.error,
    });
};

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
