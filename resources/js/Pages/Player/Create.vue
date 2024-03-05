<template>
    <AppLayout title="Create Player">
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="create" >
            <div class="text-center text">
                <div>
                    <label class="label">Nick</label>
                    <select v-model="selectedNickId" class="text-center shadow-md text-black">
                        <option v-for="user in sortedUsers" :value="user.id">{{ user.name }}</option>
                    </select>
                    <div v-if="form.errors.player_id">
                        {{ form.errors.player_id }}
                    </div>
                </div>

                <div>
                    <label class="label">Damage</label>
                    <input v-model.number="form.damage" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.damage">
                        {{ form.errors.damage }}
                    </div>
                </div>

                <div>
                    <label class="label">Obserwator</label>
                    <input v-model.number="form.is_observer" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.is_observer">
                        {{ form.errors.is_observer }}
                    </div>
                </div>

                <div>
                    <label class="label">Gwiazda</label>
                    <input v-model.number="form.is_star" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.is_star">
                        {{ form.errors.is_star }}
                    </div>
                </div>

                <div>
                    <label class="label">Season</label>
                    <input v-model.number="form.season_id" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.season_id">
                        {{ form.errors.season_id }}
                    </div>
                </div>

                <div>
                    <label class="label">Gildia</label>
                    <select v-model="selectedGuildId" class="text-center shadow-md text-black">
                        <option v-for="guild in sortedGuilds" :value="guild.id">{{ guild.name }}</option>
                    </select>
                    <div v-if="form.errors.guild_id">
                        {{ form.errors.guild_id }}
                    </div>
                </div>

                <div class="grid">
                    <button class="btn mt-3" type="submit">Create</button>
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
    season_id: props.player.season_id,
    guild_id: props.player.guild_id,
})

const create = () => {
    form.player_id = selectedNickId;
    form.guild_id = selectedGuildId
    console.log(form)

    form.post(route('player.store',  { player: props.player.id }))
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
