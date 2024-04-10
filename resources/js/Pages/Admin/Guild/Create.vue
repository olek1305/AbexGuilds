<template>
    <AppLayout title="Create a guild">
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="create" method="POST">
                <div class="form-group title">
                    <label for="name" class="grid justify-center">Nazwa gildia</label>
                    <input id="name" v-model="form.name" type="text" class="input" />
                    <div v-if="form.errors.name" class="input.error">{{ form.errors.name }}</div>
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
import {route} from "ziggy-js";

const form = useForm({
    name: null
})

const create = () => form.post(route('admin.guild.store'))
</script>
