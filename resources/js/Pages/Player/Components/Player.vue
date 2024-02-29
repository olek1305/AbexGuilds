<template>
    <tr>
        <td :class="colorColumn">{{ props.player.user.name }}</td>
        <td :class="colorColumn">{{ props.player.damage }}</td>
        <td :class="colorColumn">{{ props.player.is_observer ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn">{{ props.player.is_star ? 'Tak' : 'Nie'}}</td>
        <td :class="colorColumn">{{ props.player.guild.name }}</td>
        <td :class="colorColumn"><Link :href="route('player.edit', { player: player.id })">Edit</Link></td>
        <td :class="colorColumn"><button @click="destroy(player)">Delete</button></td>
    </tr>
</template>
<script setup>
import {Link, router} from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps({
    player: Object,
    columnIndex: Number
});

const colorColumn = props.columnIndex % 2 === 0
    ? 'bg-cyan-500 text-gray-800'
    : 'bg-sky-500 text-black';

const destroy = (player) => {
    if (confirm('Are you sure you want to delete this player?')) {
        router.delete(route('player.destroy', { player: player.id }))
    } else {
        console.log('Delete canceled');
    }
}

</script>

