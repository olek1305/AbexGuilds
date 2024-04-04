<template>
    <div>
        <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
            <thead>
            <tr class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <th>Username</th>
                <th>Saturday</th>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Fail Farm</th>
                <th>Complete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(player, index) in players" :key="player.id" class="text-center border-4 dark:border-black">
                <td :class="colorColumn(index)">{{ player.user.name }}</td>
                <td @click.prevent="toggleActivity(player, 'Saturday')"
                    :class="{'bg-red-600 text-white': player.activities.Saturday === 0, 'bg-green-400 text-black': player.activities.Saturday === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Saturday === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'Sunday')"
                    :class="{'bg-red-600 text-white': player.activities.Sunday === 0, 'bg-green-400 text-black': player.activities.Sunday === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Sunday === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'Monday')"
                    :class="{'bg-red-600 text-white': player.activities.Monday === 0, 'bg-green-400 text-black': player.activities.Monday === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Monday === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'Tuesday')"
                    :class="{'bg-red-600 text-white': player.activities.Tuesday === 0, 'bg-green-400 text-black': player.activities.Tuesday === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Tuesday === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'Wednesday')"
                    :class="{'bg-red-600 text-white': player.activities.Wednesday === 0, 'bg-green-400 text-black': player.activities.Wednesday === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Wednesday === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'FailFarm')"
                    :class="{'bg-green-700 text-white': player.activities.FailFarm === 0, 'bg-yellow-400 text-black': player.activities.FailFarm === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.FailFarm === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
                <td @click.prevent="toggleActivity(player, 'Complete')"
                    :class="{'bg-red-600 text-white': player.activities.Complete === 0, 'bg-green-400 text-black': player.activities.Complete === 1}"
                    class="CustomTable"
                >
                    <template v-if="player.activities.Complete === 1">
                        <CheckboxMarked />
                    </template>
                    <template v-else>
                        <CheckboxBlank />
                    </template>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import 'vue-material-design-icons/styles.css';
import CheckboxBlank from 'vue-material-design-icons/CheckboxBlank.vue';
import CheckboxMarked from 'vue-material-design-icons/CheckboxMarked.vue';
import {computed, ref} from "vue";
import { Inertia, Link } from "@inertiajs/inertia";
import { route } from "ziggy-js";

const props = defineProps({
    players: Array
})

const players = ref(props.players);

const toggleActivity = (player, day) => {
    if (player.activities[day] === 0 || player.activities[day] === 1) {
        player.activities[day] = player.activities[day] === 0 ? 1 : 0;
        updateActivities(player);
    }
};

const updateActivities = (player) => {
    Inertia.put(route('activity.update', {id: player.id}), {
        activities: JSON.stringify(player.activities),
        preserveScroll: true,
    });
};

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black font-normal border-b-2 border-gray-800'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black font-normal border-b-2 border-gray-800';
</script>

<style scoped>

.CustomTable{
    @apply border-2 border-black xl:h-[70px] sm:h-16
}

</style>
