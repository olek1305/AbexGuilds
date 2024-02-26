<template>
    <div class="grid container mx-auto p-4 place-items-center border-2 border-sky-500 rounded-md ">
        <p>Info player:</p>
        <p>Username: {{ player.user.name }}</p>
        <p>Guild: {{ player.guild.name }}</p>
        <p>ID user: {{ player.user.id }}</p>
        <p>ID player: {{ player.id }}</p>
    </div>
    <form class="grid grid-cols-subgrid h-screen justify-center" @submit.prevent="update" >
    <div class="text-center">
        <div>
            <label class="label">Username</label>
            <input v-model.number="form.name" type="text" class="text-center shadow-md" />
            <div v-if="form.errors.name">
                {{ form.errors.name }}
            </div>
        </div>

        <div>
            <label class="label">Damage</label>
            <input v-model.number="form.damage" type="text" class="text-center shadow-md" />
            <div v-if="form.errors.damage">
                {{ form.errors.damage }}
            </div>
        </div>
        <div>
            <button class="btn mt-3" type="submit">Update</button>
        </div>
    </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";

const props = defineProps({
    player: Object
})

const form = useForm({
    name: props.player.user.name,
    damage: props.player.damage,
})

const update = () => {
    form.put(route('player.update', { player: props.player.id }))
}
</script>
