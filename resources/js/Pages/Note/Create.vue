<template>
    <AppLayout title="Create a note">
        <form class="max-w-md mx-auto" @submit.prevent="create">
            <div class="text-center title">
                <div class="text-center">
                    <div class="mb-4">
                        <label class="label">Nick</label>
                        <select v-model="selectedNickId" class="select-field input">
                            <option class="input" v-for="user in sortedUsers" :value="user.id">{{ user.name }}</option>
                        </select>
                        <div v-if="form.errors.user_id" class="error-msg">
                            {{ form.errors.user_id }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label">Tytul</label>
                        <input v-model.number="form.title" type="text" class="input-field input input-title" />
                        <div v-if="form.errors.title" class="error-msg">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <Editor v-model="form.body"/>
                    </div>

                    <div>
                        <button class="btn mt-3 w-full" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import AppLayout from "@/Layouts/AppLayout.vue";
import { computed } from "vue";
import Editor from '@/Pages/Components/UI/MyEditor.vue'

const props = defineProps({
    users: Array,
    content: null
})

const form = useForm({
    user_id: props.user_id,
    title: props.title,
    body: props.body,

})

const create = () => {
    form.user_id = selectedNickId;

    form.post(route('note.store'))
}

let selectedNickId = null;

const sortedUsers = computed(() => {
    return props.users.sort((a, b) => a.name.localeCompare(b.name));
});

</script>

<style>
.label {
    display: block;
    margin-bottom: 0.5rem;
}

.input-field,
.select-field {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
}

.error-msg {
    color: red;
    margin-top: 0.25rem;
}
</style>
