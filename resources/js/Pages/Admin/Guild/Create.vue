<template>
    <AppLayout>
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="create" method="POST">
            <Box>
                <div class="m-2">
                    <label for="name" class="grid justify-center">Nazwa gildia</label>
                    <input id="name" v-model="form.name" type="text" class="input" />
                    <div v-if="form.errors.name" class="input.error">{{ form.errors.name }}</div>
                </div>
                <div class="grid">
                    <button class="btn dark:hover:bg-green-500" type="submit">Create</button>
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
    name: null
})

const create = () => form.post(route('admin.guild.store'))
</script>
