<template>
    <tr class="text-center hover:border-2 hover:border-black">
        <td :class="colorColumn(props.columnIndex)">{{ props.player.user.name }}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.damage }}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.is_observer ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.is_star ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn(props.columnIndex)">{{ props.player.guild.name }}</td>
        <td :class="colorColumn(props.columnIndex)" class="clickColumn hover:bg-yellow-400" @click="redirectToEdit(player)">
            <span class="link-text">Edit</span>
        </td>
        <td :class="colorColumn(props.columnIndex)" class="clickColumn hover:bg-red-600" @click="askToDestroy(player)">
            <span class="link-text">Delete</span>
        </td>
    </tr>
</template>
<script setup>
import { router} from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps({
    player: Object,
    columnIndex: Number
});

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal';


// bg-gray-700 text-white'
// bg-neutral-400
const askToDestroy = (player) => {
    if (confirm('Are you sure you want to delete this player?')) {
        router.delete(route('player.destroy', {player: player.id}))
    } else {
        console.log('Delete canceled');
    }
}

const redirectToEdit = (player) => {
    window.location.href = route('player.edit', { player: player });
};
</script>
<style scoped>
.clickColumn:hover {
    @apply border-2 cursor-pointer border-white hover:text-black;
}
</style>
