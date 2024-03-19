<template>
    <AppLayout>
        <form class="grid grid-cols-subgrid justify-center title" @submit.prevent="create">
                <div class="form-group">
                    <label for="name" class="grid justify-center">User</label>
                    <input id="name" v-model="form.name" type="text" class="input" placeholder="User"/>
                    <div v-if="form.errors.name" class="input.error">{{ form.errors.name }}</div>
                </div>
                <div class="form-group">
                    <label for="name" class="grid justify-center text-center">Email</label>
                    <input id="name" v-model="form.email" type="text" class="input" placeholder="(Pozostaw pole puste)"/>
                    <div v-if="form.errors.email" class="input.error">{{ form.errors.email }}</div>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="grid justify-center text-center">Hasło</label>
                    <input id="name" v-model="form.password" type="text" class="input" placeholder="(Pozostaw pole puste)"/>
                    <div v-if="form.errors.password" class="input.error">{{ form.errors.password }}</div>
                </div>
                <div class="flex items-center mb-4 ps-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="admin-checkbox" type="checkbox" v-model="form.is_admin" class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="admin-checkbox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Admin</label>
                </div>
                <div class="submit">
                    <button class="btn" type="submit">Utwórz</button>
                </div>
        </form>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import Box from "@/Pages/Components/UI/Box.vue";
import {route} from "ziggy-js";

const form = useForm({
    name: null,
    email: null,
    password: null,
    is_admin: false
});

const create = () => {
    form.post(route('admin.user.store'), {
        onSuccess: () => {
            form.reset();
        }
    })
}
</script>
