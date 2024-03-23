<template>
    <section
        v-if="editor"
        class="buttons text-gray-700 flex items-center flex-wrap gap-x-4 border-t border-l border-r border-gray-400 p-4 justify-center"
    >
        <button @click.prevent="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{'bg-sky-600 rounded': editor.isActive('bold')}"
                class="p-1 text">
            <BoldIcon :size="64" title="Bold" fillColor="#FF0001"/>
        </button>
        <button @click.prevent="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{'bg-sky-600 rounded': editor.isActive('italic')}"
                class="p-1 text">
            <ItalicIcon :size="64" title="Italic"/>
        </button>
        <button @click.prevent="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                :class="{'bg-sky-600 rounded': editor.isActive('strike')}"
                class="p-1 text">
            <StrikeIcon :size="64" title="Strike"/>
        </button>
    </section>
    <EditorContent :editor="editor" />
</template>

<script setup>
import StarterKit from '@tiptap/starter-kit'
import { EditorContent, useEditor } from '@tiptap/vue-3'
import BoldIcon from 'vue-material-design-icons/FormatBold.vue'
import ItalicIcon from 'vue-material-design-icons/FormatItalic.vue'
import StrikeIcon from 'vue-material-design-icons/FormatStrikethroughVariant.vue'

const props = defineProps({
    modelValue: String,
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'input input-field mb-4 min-h-[12rem] max-h-[12rem] overflow-y-auto'
        },
        transformPastedText(text) {
            return text.toUpperCase()
        }
    },
    content: props.modelValue,
    extensions: [
        StarterKit,
    ],
    onUpdate: ({ editor }) => {
        const newContent = editor.getHTML();
        emit('update:modelValue', newContent);
    }
})

</script>
