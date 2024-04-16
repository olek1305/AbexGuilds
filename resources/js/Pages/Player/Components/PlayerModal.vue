<template>
    <div v-if="showModal" @click="handleBackgroundClick" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-55">
        <div class="bg-white p-4 rounded shadow-md dark:bg-gray-800">
            <div v-if="!showKickConfirmation && !showBanConfirmation && !showDeleteConfirmation">
                <Box class="m-1">
                    <h2 class="text-lg font-bold mb-2 text">Gracz: {{ props.player.user.name }}</h2>
                    <button type="button" class="bg-blue-500 hover:bg-gray-300 textbtn" @click="editPlayer(props.player)">Edit</button>
                    <button type="button" class="bg-yellow-600 hover:bg-gray-300 textbtn" @click="notePlayer(props.player)">Note</button>
                    <button type="button" class="bg-red-500 hover:bg-gray-300 textbtn" @click="showDeleteConfirmation = true">Delete</button>
                </Box>
                <Box class="m-1">
                    <div>
                        <h2 class="text-lg font-bold text">przeniesienie do innej gildii</h2>
                        <select v-model="selectedGuild">
                            <option v-for="guild in guilds" :key="guild.id" :value="guild">
                                {{ guild.name }}
                            </option>
                        </select>
                        <button class="bg-green-500 hover:bg-gray-300 textbtn" @click="transferPlayer(props.player)" :disabled="!selectedGuild">Transfer</button>
                    </div>
                </Box>
                <Box class="m-1">
                    <h2 class="text">Admin Tool</h2>
                    <button type="button" class="bg-red-500 hover:bg-gray-300 textbtn" @click="showKickConfirmation = true">Kick</button>
                    <button type="button" class="bg-red-500 hover:bg-gray-300 textbtn" @click="showBanConfirmation = true">Ban</button>
                </Box>
                <button type="button" class="bg-gray-500 hover:bg-gray-300 textbtn" @click="closeModal">Close</button>
            </div>
            <div v-else-if="showKickConfirmation">
                <transition>
                    <div>
                        <h2 class="text-lg font-bold mb-2 dark:text-white">Are you sure?</h2>
                        <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="kickPlayer(props.player)">Yes</button>
                        <button class="bg-blue-500 hover:bg-gray-300 textbtn" @click="showKickConfirmation = false">No</button>
                    </div>
                </transition>
            </div>
            <div v-else-if="showBanConfirmation">
                <transition>
                    <div>
                        <h2 class="text-lg font-bold mb-2 dark:text-white">Are you sure you want to ban this player?</h2>
                        <div class="form-group">
                            <label for="name" class="grid justify-center text-center">opcjonalnie</label>
                            <input id="name" v-model="form.uuid" type="text" class="input" placeholder="(wprowadź UUID)"/>
                            <div v-if="form.errors.email" class="input.error">{{ form.errors.uuid }}</div>
                        </div>
                        <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="() => banPlayer(props.player)">Yes</button>
                        <button class="bg-blue-500 hover:bg-gray-300 textbtn" @click="showBanConfirmation = false">No</button>
                    </div>
                </transition>
            </div>
            <div v-else-if="showDeleteConfirmation">
                <transition>
                    <div>
                        <h2 class="text-lg font-bold mb-2 dark:text-white">Are you sure?</h2>
                        <button class="bg-red-500 hover:bg-gray-300 textbtn" @click="deletePlayer(props.player)">Yes</button>
                        <button class="bg-blue-500 hover:bg-gray-300 textbtn" @click="showDeleteConfirmation = false">No</button>
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
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    player: Object,
    guilds: Array,
    showModal: Boolean,
    columnIndex: Number
});

const form = useForm({
    uuid: null
})

const emit = defineEmits(['close']);

let showDeleteConfirmation = ref(false);
let showKickConfirmation = ref(false);
let showBanConfirmation = ref(false);
let selectedGuild = ref(null)


const editPlayer = (player) => {
    router.get(route('player.edit', { player: player.id }));
}

const notePlayer = (player) => {
    router.get(route('note.show', { note: player.user.id }));
}

const kickPlayer = (player) => {
    router.delete(route('admin.user.destroy', { user: player.user.id, action: 'kick' }));
    emit('close');
}

const banPlayer = (player) => {
    console.log(player.user.id)
    router.delete(route('admin.user.destroy', { user: player.user.id, action: 'ban' }), {
        data: {
            uuid: form.uuid
        }
    });
    emit('close');
}

const deletePlayer = (player) => {
    router.delete(route('player.destroy', { player: player.id }));
    emit('close');
}

const transferPlayer = (player) => {
    router.patch(route('players.transfer', { player: player.id }), {
        guild_id: selectedGuild.value.id,
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
