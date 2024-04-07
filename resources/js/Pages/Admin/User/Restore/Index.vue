<template>
    <AppLayout>
        <Box class="w-52 mx-auto">
            <div class="form-group mb-2">
                <label class="text-center text w-44">User</label>
                <select v-model="selectedNickId" class="input">
                    <option class="input" v-for="user in sortedDeletedUsers" :value="user.id">
                        {{ user.name }}
                    </option>
                </select>
            </div>
            <div class="submit">
                <button class="btn" @click="restoreUser" :disabled="!selectedNickId">Przywróć użytkownika</button>
            </div>
        </Box>
    </AppLayout>
</template>

<script setup>
import { defineProps, computed, ref } from 'vue';
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
