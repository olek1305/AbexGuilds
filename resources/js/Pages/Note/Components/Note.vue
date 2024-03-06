<template>
    <div class="dark:text-white border-2 border-sky-500 p-1 bg-amber-100 dark:bg-sky-800 flex flex-col">
        <p>Notatnik: ID {{ props.note.id }}: {{ shortCutData(props.note.created_at) }}</p>
        <p class="font-semibold" v-if="props.note.user">Gracz: {{ props.note.user.name }}</p>
        <p class="font-semibold">Powód: {{ props.note.title }}</p>
        <p class="font-semibold">{{ props.note.body }}</p>
        <div class="flex justify-center">
            <button class="btn ml-2 flex-grow hover:bg-yellow-400" @click="editNote">Edit</button>
            <button class="btn ml-2 flex-grow hover:bg-red-600" @click="deleteNote">Delete</button>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    note: Object
})

const shortCutData = (data) => {
    if (!data) return '';
    return data.split('T')[0];
};

const editNote = () => {

}

const deleteNote = () => {

}
</script>
