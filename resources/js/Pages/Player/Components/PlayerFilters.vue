<template>
    <form @submit.prevent="filter" class="flex flex-col items-center sm:flex-row sm:flex-wrap sm:justify-center pt-2">
        <div class="mb-4 sm:mb-0 sm:mr-2">
            <input v-model.number="filterForm.damageFrom" type="text" placeholder="Damage from" class="input" />
        </div>
        <div class="mb-4 sm:mb-0 sm:mr-2">
            <input v-model.number="filterForm.damageTo" type="text" placeholder="Damage to" class="input" />
        </div>
        <div class="mb-4 sm:mb-0 sm:mr-2">
            <select v-model.number="filterForm.guild_id" class="input">
                <option :value="null" hidden>Nazwa Gildia</option>
                <option v-for="(guild, index) in guilds" :key="index" :value="guild.id">{{ guild.name }}</option>
            </select>
        </div>

        <div class="mb-4 sm:mb-0 sm:mr-2">
            <select v-model.number="filterForm.season" class="input">
                <option :value="null" hidden>season</option>
                <option v-for="n in 12" :key="n" :value="n">{{ n }}</option>
            </select>
        </div>
        <div class="flex flex-col sm:flex-row p-2">
            <button type="submit" class="btn mb-2 sm:mb-0 sm:mr-2">Filter</button>
            <button type="reset" @click="clear" class="btn">Clear</button>
        </div>
    </form>
</template>

<style scoped>
/* Dodatkowe style CSS */
form {
    max-width: 800px; /* Maksymalna szerokość formularza */
    margin: auto; /* Wyśrodkowanie formularza */
}
</style>


<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    filters: Object,
    guilds: Object
})

const filterForm = useForm({
    guild_id: props.filters.guild_id ?? null,
    damageFrom: props.filters.damageFrom ?? null,
    damageTo: props.filters.damageTo ?? null,
    season: props.filters.season ?? null,
})

const filter = () => {
    filterForm.get(
        route('player.index'),
        {
            preserveState: true,
            preserveScroll: true
        },
    )
}

const clear = () => {
    filterForm.guild_id = null
    filterForm.damageFrom = null
    filterForm.damageTo = null
    filterForm.season = null
    filter()
}
</script>
