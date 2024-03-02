<template>
    <div class="flex gap-1">
        <Link
            v-for="(link, index) in links"
            :key="index" class="py-2 px-4 rounded-md"
            :href="link.url !== null ? link.url : ''"
            :class="{'bg-white dark:bg-gray-500 border-b border-gray-100 dark:border-gray-70 dark:text-white': link.active}"
            v-html="link.label"
        />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({links: Array})
</script>
