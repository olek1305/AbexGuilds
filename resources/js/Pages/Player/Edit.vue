<template>
    <AppLayout title="Edit Player">
        <div class="grid">
            <div class="mx-auto p-2 border-2 border-sky-500 rounded-md text inline-block ">
                <p>Info player:</p>
                <p>Username: {{ player.user.name }}</p>
                <p>Guild: {{ player.guild.name }}</p>
                <p>ID user: {{ player.user.id }}</p>
                <p>ID player: {{ player.id }}</p>
            </div>
        </div>
        <form class="grid grid-cols-subgrid justify-center" @submit.prevent="update" >
            <div class="text-center text">
                <div>
                    <label class="label">Damage</label>
                    <input v-model.number="form.damage" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.damage">
                        {{ form.errors.damage }}
                    </div>
                </div>

                <div>
                    <label class="label">Obserwator</label>
                    <input v-model.number="form.observer" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.observer">
                        {{ form.errors.observer }}
                    </div>
                </div>

                <div>
                    <label class="label">Gwiazda</label>
                    <input v-model.number="form.star" type="text" class="text-center shadow-md text-black" />
                    <div v-if="form.errors.star">
                        {{ form.errors.star }}
                    </div>
                </div>

                <div class="grid">
                    <button class="btn mt-3" type="submit">Update</button>
                </div>
            </div>
        </form>
        <div class="grid text justify-center">
            <button class="btn mt-3"><Link :href="route('player.index')">Cancel</Link></button>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link, router, useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    player: Object
})

const form = useForm({
    damage: props.player.damage,
    star: props.player.is_star,
    observer: props.player.is_observer,
})

const update = () => {
    form.put(route('player.update', { player: props.player.id }))
}

const destroy = () => {
    router.delete(route('player.destroy', { player: props.player.id }))
}
</script>
