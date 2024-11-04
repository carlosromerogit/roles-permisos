<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";
defineOptions({ layout: AuthenticatedLayout });
const props = defineProps({
    user: Object,
    role: Object,
    roles: Array,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: null,
    password_confirmation: null,
    role: props.role[0].id,
});

function handleSubmit() {
    form.put(`/dashboard/usuarios/${props.user.id}`);
}
</script>
<template>
    <div>
        <Link
            href="/dashboard/usuarios"
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
            <h2 class="text-2xl font-semibold mb-2">Editar usuario</h2>
            <hr />
        </div>
        <div>
            <form
                autocomplete="off"
                class="flex flex-col gap-2 max-w-80"
                @submit.prevent="handleSubmit"
            >
                <div class="flex items-center justify-between">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" v-model="form.name" />
                </div>
                <div class="text-red-600" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>

                <div class="flex items-center justify-between">
                    <label for="email">Email</label>
                    <input type="text" id="email" v-model="form.email" />
                </div>
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
                <div class="flex items-center justify-between">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        v-model="form.password"
                    />
                </div>
                <div class="text-red-600" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
                <div class="flex items-center justify-between">
                    <label for="password_confirmation"
                        >Confirmar Contraseña</label
                    >
                    <input
                        type="password"
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                    />
                </div>
                <div
                    class="text-red-600"
                    v-if="form.errors.password_confirmation"
                >
                    {{ form.errors.password_confirmation }}
                </div>

                <div class="flex items-center justify-between">
                    <label for="role">Tipo de usuario</label>
                    <select name="role" id="role" v-model="form.role">
                        <option v-for="role in roles" :value="role.id">
                            {{ role.name }}
                        </option>
                    </select>
                </div>
                <div class="text-red-600" v-if="form.errors.role">
                    {{ form.errors.role }}
                </div>

                <button
                    type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded self-start"
                    :disabled="form.processing"
                >
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
