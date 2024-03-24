<template>
    <tr class="text-center hover:border-1 hover:border-sky-700" :key="props.player.id">
        <td :class="colorColumn(props.columnIndex)">{{ props.player.user.name }}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.damage }}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.is_star ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.is_observer ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn(props.columnIndex)" class="border-r-2 border-gray-700">{{ props.player.guild.name }}</td>
        <td :class="colorColumn(props.columnIndex)" class="hover:bg-gray-300 font-semibold cursor-pointer" @click.stop="selectedPlayer = props.player; showModal = true">
            <button>
                Edit
            </button>
        </td>
        <PlayerModal :player="selectedPlayer" :show-modal="showModal" :column-index="props.columnIndex" @close="showModal = false" :guilds="guilds" />
    </tr>
</template>
<script setup>
import PlayerModal from "@/Pages/Player/Components/PlayerModal.vue";
import {ref} from "vue";

const props = defineProps({
    player: Object,
    guilds: Object,
    columnIndex: Number

});

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal border-b-2 border-gray-800'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal border-b-2 border-gray-800';

let selectedPlayer = ref(null);
let showModal = ref(false);
</script>
