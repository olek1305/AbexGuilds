<template>
    <AppLayout>
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="create" method="POST">
            <Box>
                <div class="m-2">
                    <label for="name" class="grid justify-center">User</label>
                    <input id="name" v-model="form.name" type="text" class="input" placeholder="User"/>
                    <div v-if="form.errors.name" class="input.error">{{ form.errors.name }}</div>
                </div>
                <div class="m-2">
                    <label for="name" class="grid justify-center text-center">Email</label>
                    <input id="name" v-model="form.email" type="text" class="input" placeholder="(Pozostaw pole puste)"/>
                    <div v-if="form.errors.email" class="input.error">{{ form.errors.email }}</div>
                </div>
                <div class="m-2">
                    <label for="name" class="grid justify-center text-center">Hasło</label>
                    <input id="name" v-model="form.password" type="text" class="input" placeholder="(Pozostaw pole puste)"/>
                    <div v-if="form.errors.password" class="input.error">{{ form.errors.password }}</div>
                </div>
                <div class="grid">
                    <button class="btn dark:hover:bg-green-500" type="submit">Utwórz</button>
                </div>
            </Box>
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
    password: null
})

const create = () => form.post(route('admin.user.store'))
</script>
