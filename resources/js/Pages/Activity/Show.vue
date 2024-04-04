<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <ActivityTable class="overflow-x-auto" :players="players"/>
        </div>
    </AppLayout>
</template>

<script setup>
import ActivityTable from "@/Pages/Activity/Components/ActivityTable.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    players: Array
})
</script>
