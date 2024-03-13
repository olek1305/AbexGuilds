<template>
    <tr class="text-center hover:border-2 hover:border-black" :key="props.player.id">
        <td v-once :class="colorColumn(props.columnIndex)">{{ props.player.user.name }}</td>
        <td v-once :class="colorColumn(props.columnIndex)">{{ props.player.damage }}</td>
        <td v-once :class="colorColumn(props.columnIndex)">{{ props.player.is_star ? 'Tak' : 'Nie'}}</td>
        <td v-once :class="colorColumn(props.columnIndex)">{{ props.player.is_observer ? 'Tak' : 'Nie'}}</td>
        <td v-once :class="colorColumn(props.columnIndex)">{{ props.player.guild.name }}</td>
        <td :class="colorColumn(props.columnIndex)">
            <button @click.stop="selectedPlayer = props.player; showModal = true">
                Edit
            </button>
            <PlayerModal :player="selectedPlayer" :show-modal="showModal" @close="showModal = false" />
        </td>
    </tr>
</template>
<script setup>
import PlayerModal from "@/Pages/Player/Components/PlayerModal.vue";
import {ref} from "vue";

const props = defineProps({
    player: Object,
    columnIndex: Number
});

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal';

let selectedPlayer = ref(null);
let showModal = ref(false);
</script>
