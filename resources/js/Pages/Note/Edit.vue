<template>
    <AppLayout title="Edit the note">
        <form class="max-w-md mx-auto" @submit.prevent="update">
            <div class="text-center title">
                <div class="text-center">
                    <div class="mb-4">
                        <label class="label">Tytul</label>
                        <input v-model="form.title" type="text" class="input-field input input-title" />
                        <div v-if="form.errors.title" class="error-msg">
                            {{ form.errors.title }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <Editor v-model="form.body"/>
                    </div>

                    <div>
                        <button class="btn mt-3 w-full" type="submit">Aktualizacja</button>
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
import Editor from "@/Pages/Components/UI/MyEditor.vue";

const props = defineProps({
    note: Object
})
const form = useForm({
    title: props.note.title,
    body: props.note.body,
})

const update = () => {
    form.put(route('note.update', {note: props.note.id}))
};

</script>

<style>
.label {
    display: block;
    margin-bottom: 0.5rem;
}

.input-field {
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
