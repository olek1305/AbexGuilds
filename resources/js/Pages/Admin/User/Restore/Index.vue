<template>
    <AppLayout>
        <Box>
            <div class="mb-4">
                <label class="label">Nick</label>
                <select v-model="selectedNickId" class="select-field input">
                    <option class="input" v-for="user in sortedDeletedUsers" :value="user.id">
                        {{ user.name }}
                    </option>
                </select>
            </div>
            <div class="flex justify-end">
                <button @click="restoreUser" v-if="selectedNickId">Przywróć użytkownika</button>
            </div>
        </Box>
    </AppLayout>
</template>

<script setup>
import {defineProps, computed, ref} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import { route } from "ziggy-js";
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: Array
});

const form = useForm({

})

const selectedNickId = ref(null);

const sortedDeletedUsers = computed(() => {
    return props.users.filter((user) => user.deleted_at !== null).sort((a, b) => a.name.localeCompare(b.name));
});

const restoreUser = () => {
    if (!selectedNickId.value) return;
        form.post(route('admin.user.restore', { user: selectedNickId.value })
    );
}
</script>
