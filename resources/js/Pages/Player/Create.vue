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
                        <label class="label">Damage</label>
                        <input v-model.number="form.damage" type="text" class="input-field input" />
                        <div v-if="form.errors.damage" class="error-msg">
                            {{ form.errors.damage }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Obserwator</label>
                        <input v-model.number="form.is_observer" type="text" class="input-field input" />
                        <div v-if="form.errors.is_observer" class="error-msg">
                            {{ form.errors.is_observer }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Gwiazda</label>
                        <input v-model.number="form.is_star" type="text" class="input-field input" />
                        <div v-if="form.errors.is_star" class="error-msg">
                            {{ form.errors.is_star }}
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
                        <label class="label">Gildia</label>
                        <select v-model="selectedGuildId" class="input-field input">
                            <option v-for="guild in sortedGuilds" :value="guild.id">{{ guild.name }}</option>
                        </select>
                        <div v-if="form.errors.guild_id" class="error-msg">
                            {{ form.errors.guild_id }}
                        </div>
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
    is_observer: props.player.is_observer,
    is_star: props.player.is_star,
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
