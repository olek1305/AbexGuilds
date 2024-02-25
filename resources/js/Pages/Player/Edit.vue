<template>
    <div>
        <p>Info player:</p>
        <p>Username: {{ props.player.user.name }}</p>
        <p>Guild: {{ props.player.guild.name }}</p>
        <p>ID: {{ props.player.player_id }}</p>
    </div>
    <form method="POST" class="grid grid-cols-6 gap-4" @submit.prevent="update" >
    <div>
        <div>
            <label class="label">Username</label>
            <input v-model.number="form.name" type="text" class="input" />
            <div v-if="form.errors.name">
                {{ form.errors.name }}
            </div>
        </div>

        <div>
            <label class="label">Damage</label>
            <input v-model.number="form.damage" type="text" class="input" />
            <div v-if="form.errors.damage">
                {{ form.errors.damage }}
            </div>
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </div>
    </form>
</template>

<script setup>
import {router, useForm} from '@inertiajs/vue3'
import { route } from "ziggy-js";

const props = defineProps({
    player: Object
})

const form = useForm({
    name: props.player.user.name,
    damage: props.player.damage
})

const update = () => {
    form.put(route('player.update', { player: props.player.player_id }))
}
</script>
