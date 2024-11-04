<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    description: null,
});

function handleSubmit() {
    form.post("/dashboard/post");
}

defineOptions({ layout: AuthenticatedLayout });
</script>
<template>
    <div>
        <Link
            href="/dashboard/post"
            class="px-2 py-1 bg-gray-200 text-gray-600 rounded font-semibold flex items-center w-24"
            as="button"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-box-arrow-up-left"
                viewBox="0 0 16 16"
            >
                <path
                    fill-rule="evenodd"
                    d="M7.364 3.5a.5.5 0 0 1 .5-.5H14.5A1.5 1.5 0 0 1 16 4.5v10a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 3 14.5V7.864a.5.5 0 1 1 1 0V14.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5H7.864a.5.5 0 0 1-.5-.5"
                />
                <path
                    fill-rule="evenodd"
                    d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 0 1H1.707l8.147 8.146a.5.5 0 0 1-.708.708L1 1.707V5.5a.5.5 0 0 1-1 0z"
                />
            </svg>
            <span class="ml-1">Regresar</span>
        </Link>
        <div>
            <h2 class="text-2xl font-semibold mb-2">Crear post</h2>
            <hr />
        </div>
        <div>
            <form
                autocomplete="off"
                class="flex flex-col gap-2 max-w-80"
                @submit.prevent="handleSubmit"
            >
                <div class="flex items-center justify-between">
                    <label for="title">Título</label>
                    <input type="text" id="title" v-model="form.title" />
                </div>
                <div class="text-red-600" v-if="form.errors.title">
                    {{ form.errors.title }}
                </div>

                <div class="flex items-center justify-between">
                    <label for="description">Descripción</label>
                    <input
                        type="text"
                        id="description"
                        v-model="form.description"
                    />
                </div>
                <div class="text-red-600" v-if="form.errors.description">
                    {{ form.errors.description }}
                </div>

                <button
                    type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded self-start"
                    :disabled="form.processing"
                >
                    Guardar
                </button>
            </form>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
