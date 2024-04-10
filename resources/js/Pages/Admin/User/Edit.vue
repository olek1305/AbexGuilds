<template>
    <AppLayout title="Edit user">
        <div>
            <h1 class="title text-center m-2">Edycja użytkownika</h1>
            <form @submit.prevent="onSubmit">
                <div class="form-group w-42">
                    <label for="name" class="title text-center">Nazwa</label>
                    <input type="text" id="name" v-model="form.name" class="input" />
                </div>
                <div class="form-group w-42">
                    <label for="email" class="title text-center">Email</label>
                    <input type="email" id="email" v-model="form.email" class="input" />
                </div>
                <div class="form-group">
                    <label for="password" class="title text-center">Hasło</label>
                    <input type="password" id="password" v-model="form.password" class="input" />
                </div>
                <div class="submit mt-2">
                    <button type="submit" class="btn btntext">Zapisz</button>
                    <button type="button" class="btn btntext" @click="deleteUser">Usuń</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {route} from "ziggy-js";

const props = defineProps({
    user: Object
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: ''
});

const onSubmit = () => {
    form.put(route('admin.user.update', {user: props.user.id}))
}

const deleteUser = () => {
    if (confirm('Czy na pewno chcesz usunąć użytkownika?')) {
        form.delete(route('admin.user.destroy', {user: props.user.id}), {
            onSuccess: () => {
                this.$inertia.reload();
            }
        });
    }
}

</script>
