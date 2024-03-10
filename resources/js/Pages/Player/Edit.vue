<template>
    <AppLayout title="Edit Player">
        <div class="grid">
            <div class="mx-auto p-2 border-2 border-sky-500 rounded-md text inline-block m-1">
                <p>Info player:</p>
                <p>Username: {{ player.user.name }}</p>
                <p>Guild: {{ player.guild.name }}</p>
                <p>ID user: {{ player.user.id }}</p>
                <p>ID player: {{ player.id }}</p>
                <p>Season: {{ player.season }}</p>
            </div>
        </div>
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="update" >
            <div class="text-center text">
                <div class="m-1">
                    <label class="label">Damage</label>
                    <input v-model.number="form.damage" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.damage">
                        {{ form.errors.damage }}
                    </div>
                </div>

                <div class="flex items-center m-2 ps-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="gwiazda-checkbox" type="checkbox" v-model="form.is_star" class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="gwiazda-checkbox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Gwiazda</label>
                </div>

                <div class="flex items-center m-2 ps-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="obserwator-checkbox" type="checkbox" v-model="form.is_observer" class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="obserwator-checkbox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Obserwator</label>
                </div>

                <div class="grid">
                    <button class="btn h-full" type="submit">Aktualizacja</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    player: Object
})

const form = useForm({
    damage: props.player.damage,
    is_star: !!props.player.is_star,
    is_observer: !!props.player.is_observer,
})

const update = () => {
    form.put(route('player.update', { player: props.player.id }))
}
</script>
