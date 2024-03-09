<template>
    <AppLayout title="Create Player">
        <form class="max-w-md mx-auto" @submit.prevent="create">
            <div class="text-center text">
                <div class="text-center">
                    <div class="mb-4">
                        <label class="label">Nick</label>
                        <select v-model="selectedNickId" class="select-field input">
                            <option class="input" v-for="user in sortedUsers" :value="user.id">{{ user.name }}</option>
                        </select>
                        <div v-if="form.errors.player_id" class="error-msg">
                            {{ form.errors.player_id }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Gildia</label>
                        <select v-model="selectedGuildId" class="input-field input">
                            <option v-for="guild in sortedGuilds" :value="guild.id">{{ guild.name }}</option>
                        </select>
                        <div v-if="form.errors.guild_id" class="error-msg">
                            {{ form.errors.guild_id }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Season</label>
                        <input v-model.number="form.season" type="text" class="input-field input" />
                        <div v-if="form.errors.season" class="error-msg">
                            {{ form.errors.season }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Damage</label>
                        <input v-model.number="form.damage" type="text" class="input-field input" />
                        <div v-if="form.errors.damage" class="error-msg">
                            {{ form.errors.damage }}
                        </div>
                    </div>

                    <div class="flex items-center mb-4 ps-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="gwiazda-checkbox" type="checkbox" v-model="form.is_star" class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                        <label for="gwiazda-checkbox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Gwiazda</label>
                    </div>

                    <div class="flex items-center mb-4 ps-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="obserwator-checkbox" type="checkbox" v-model="form.is_observer" class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                        <label for="obserwator-checkbox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Obserwator</label>
                    </div>

                    <div>
                        <button class="btn mt-3 w-full" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import AppLayout from "@/Layouts/AppLayout.vue";
import { computed } from "vue";

const props = defineProps({
    player: Array,
    users: Array,
    guilds: Array
})

const form = useForm({
    player_id: props.player_id,
    damage: props.player.damage,
    is_observer: props.player.is_observer || 0,
    is_star: props.player.is_star || 0,
    season: props.player.season,
    guild_id: props.player.guild_id,
})

const create = () => {
    form.player_id = selectedNickId;
    form.guild_id = selectedGuildId

    form.post(route('player.store'))
}

let selectedNickId = null;
let selectedGuildId = null;

const sortedUsers = computed(() => {
    return props.users.sort((a, b) => a.name.localeCompare(b.name));
});

const sortedGuilds = computed(() => {
    return props.guilds.sort((a, b) => a.name.localeCompare(b.name));
})

</script>

<style>
.label {
    display: block;
    margin-bottom: 0.5rem;
}

.input-field,
.select-field {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
}

.error-msg {
    color: red;
    margin-top: 0.25rem;
}
</style>
