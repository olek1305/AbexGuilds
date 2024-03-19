<template>
    <AppLayout>
        <div>
            <h1 class="title text-center m-1">Edycja użytkownika</h1>
            <form @submit.prevent="onSubmit">
                <div class="form-group">
                    <label for="name" class="title">Nazwa:</label>
                    <input type="text" id="name" v-model="form.name" class="form-control input" />
                </div>
                <div class="form-group">
                    <label for="email" class="title">Email:</label>
                    <input type="email" id="email" v-model="form.email" class="form-control input" />
                </div>
                <div class="form-group">
                    <label for="password" class="title">Hasło:</label>
                    <input type="password" id="password" v-model="form.password" class="form-control input" />
                </div>
                <div class="submit mt-1">
                    <button type="submit" class="btn btn-primary title">Zapisz</button>
                    <button type="button" class="btn btn-danger title" @click="deleteUser">Usuń</button>
                    <button type="button" class="btn btn-warning title" v-if="user.deleted_at" @click="restoreUser">Przywróć</button>
                </div>
                <div class="alert alert-success" v-if="successMessage">{{ successMessage }}</div>
                <div class="alert alert-danger" v-if="errorMessage">{{ errorMessage }}</div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    user: Object
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const onSubmit = () => {
    form.put(route('admin.user.update', { user: props.user.id }))
}

const deleteUser = () => {
    if (confirm('Czy na pewno chcesz usunąć użytkownika?')) {
        form.delete(route('admin.user.destroy', { user: props.user.id }), {
            onSuccess: () => {
                this.$inertia.reload();
            }
        });
    }
}

const restoreUser = () => {
    form.post(route('admin.user.restore', { user: props.user.id }), {
        onSuccess: () => {
            form.reset('password');
            this.user.deleted_at = null;
        }
    });
}

</script>
