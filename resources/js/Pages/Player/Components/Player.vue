<template>
        <tr>
            <td>{{ player.user.name }}</td>
            <td>{{ player.damage }}</td>
            <td>{{ player.is_observer}}</td>
            <td>{{ player.is_star}}</td>
            <td>{{ player.guild.name }}</td>
        </tr>
</template>
<script setup>
defineProps({
    player: Object,
})



</script>

