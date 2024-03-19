<template>
    <form @submit.prevent="filter" class="flex flex-col items-center sm:flex-row sm:flex-wrap sm:justify-center pt-1">
        <div class="mb-2 flex flex-wrap justify-center">
            <input v-model.number="filterForm.damageFrom" type="text" placeholder="od ilu dmg?" class="input w-48 placeholder-gray-500 border" />

            <input v-model.number="filterForm.damageTo" type="text" placeholder="do ilu dmg?" class="input w-48 placeholder-gray-500 border" />

            <select v-model.number="filterForm.guild_id" class="input w-48 border">
                <option :value="null" hidden>Nazwa Gildia</option>
                <option v-for="(guild, index) in guilds" :key="index" :value="guild.id">{{ guild.name }}</option>
            </select>

            <select v-model.number="filterForm.season" class="input w-48 border">
                <option :value="null" hidden>Season</option>
                <option v-for="season in sortedSeasons" :key="season" :value="season">{{ season }}</option>
            </select>
        </div>
        <div class="mb-2 w-52 flex mr-1">
            <button type="submit" class="flex btn justify-center w-48">Filter</button>
            <button type="reset" @click="clear" class="flex btn justify-center w-48">Clear</button>
        </div>
    </form>
</template>

<style scoped>
form {
    max-width: 800px;
    margin: auto;
}
</style>


<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { route } from "ziggy-js";

const props = defineProps({
    filters: Object,
    guilds: Object,
    seasons: Object
})

const filterForm = useForm({
    guild_id: props.filters.guild_id ?? null,
    damageFrom: props.filters.damageFrom ?? null,
    damageTo: props.filters.damageTo ?? null,
    season: props.filters.season ?? null,
})

let filterTimeout = null;

const filter = () => {
    clearTimeout(filterTimeout);
    filterTimeout = setTimeout(() => {
        filterForm.get(
            route('player.index'),
            {
                preserveState: true,
                preserveScroll: true
            },
        );
    }, 1000);
}


const clear = () => {
    filterForm.guild_id = null
    filterForm.damageFrom = null
    filterForm.damageTo = null
    filterForm.season = null
    filter()
}

const sortedSeasons = computed(() => {
    return props.seasons.slice().sort((a, b) => a - b);
});
</script>

<style scoped>
.border {
    @apply dark:border-sky-800
}
</style>
