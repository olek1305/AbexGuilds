<template>
        <tr>
            <td>{{ player.user.name }}</td>
            <td>{{ player.damage }}</td>
            <td>{{ player.is_observer}}</td>
            <td>{{ player.is_star}}</td>
            <td>{{ player.guild.name }}</td>
            <td><Link :href="route('player.edit', { player: player.id })">Edit</Link></td>
        </tr>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";

defineProps({
    player: Object,
})
</script>

