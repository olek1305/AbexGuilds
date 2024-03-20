<template>
    <AppLayout>
        <div>
            <h1 class="title text-center mb-1">Lista użytkowników</h1>
            <table class="table-auto text-2xl w-full text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-xl">
                        <th class="text-center" v-for="(column, index) in columns" :key="index">
                            {{ column }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center hover:border-2 hover:border-black" v-for="(user, index) in users.data" :key="user.id">
                        <td :class="colorColumn(index)" class="font-normal">{{ user.id }}</td>
                        <td :class="colorColumn(index)" class="font-normal border-r-2 border-gray-700">{{ user.name }}</td>
                        <td :class="colorColumn(index)" class="font-normal" @click.stop="selectedUser = user; showModal = true">Edit</td>
                        <ActionModal :user="selectedUser" :show-modal="showModal" :column-index="props.columnIndex" @close="showModal = false" />
                    </tr>
                </tbody>
            </table>
            <div v-if="users.data.length" class="w-full flex justify-center mt-4 mb-4 dark:text-gray-400">
                <Pagination :links="users.links"/>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionModal from "@/Pages/Admin/User/Components/ActionModal.vue";
import { ref } from "vue";
import Pagination from "@/Pages/Components/UI/Pagination.vue";

const columns = ['ID', 'Nazwa', 'Akcje'];

const props = defineProps({
    users: Object,
    columnIndex: Number
})

const colorColumn = (index) => index % 2 === 0
    ? 'dark:bg-cyan-300 dark:text-black bg-orange-200 text-black'
    : 'dark:bg-blue-400 dark:text-zinc-950 bg-amber-400 text-black';


let selectedUser = ref(null);
let showModal = ref(false);
</script>
