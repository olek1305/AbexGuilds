<template>
        <tr>
            <td>{{ player.user.name }}</td>
            <td>{{ player.damage }}</td>
            <td>{{ player.is_observer ? 'Tak' : 'Nie'}}</td>
            <td>{{ player.is_star ? 'Tak' : 'Nie'}}</td>
            <td>{{ player.guild.name }}</td>
            <td><Link :href="route('player.edit', { player: player.id })">Edit</Link></td>
            <td><button @click="destroy(player)">Delete</button></td>
        </tr>
</template>
<script setup>
import {Link, router} from "@inertiajs/vue3";
import { route } from "ziggy-js";

defineProps({
    player: Object,
})
const destroy = (player) => {
    if (confirm('Are you sure you want to delete this player?')) {
        router.delete(route('player.destroy', { player: player.id }))
    } else {
        console.log('Delete canceled');
    }
}

</script>

