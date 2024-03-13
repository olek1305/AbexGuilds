<template>
    <AppLayout>
        <div>
            <h1>Lista użytkowników</h1>
            <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-xl">
                    <th class="text-center" v-for="(column, index) in columns" :key="index">
                        {{ column }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-center hover:border-2 hover:border-black" v-for="(user, index) in users" :key="user.id">
                    <td :class="colorColumn(index)" class="font-normal">{{ user.id }}</td>
                    <td :class="colorColumn(index)" class="font-normal">{{ user.name }}</td>
                    <td :class="colorColumn(index)" class="font-normal">
                        <a class="btn" :href="route('admin.user.edit', { user: user.id })">Edytuj</a>
                        <button class="btn" @click="deleteUser(user)">Usuń</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {route} from "ziggy-js";
import {Inertia} from "@inertiajs/inertia";

const columns = ['ID', 'Nazwa', 'Akcje?'];

const props = defineProps({
    users: Array,
    columnIndex: Boolean
})

const deleteUser = (user) => {
    if (confirm('Czy na pewno usunąć użytkownika?')) {
        Inertia.delete(route('admin.user.destroy', { user: user }), {
            preserveScroll: true
        });
    }
}

const colorColumn = (columnIndex) => {
    const colorClasses = [
        'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black',
        'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black'
    ];

    return colorClasses[columnIndex % colorClasses.length];
}
</script>
