<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";
const props = defineProps({
    role: Object,
    permissions: Array,
    rolePermissions: Array,
});

const form = useForm({
    name: props.role.name,
    permissions: props.rolePermissions.map((permission) => permission.id),
});

function handleSubmit() {
    form.put(`/dashboard/roles/${props.role.id}`);
}

defineOptions({ layout: AuthenticatedLayout });
</script>
<template>
    <pre>{{}}</pre>
    <div>
        <Link
            href="/dashboard/roles"
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
            <h2 class="text-2xl font-semibold mb-2">Editar role</h2>
            <hr class="mb-2" />
        </div>
        <div>
            <form
                autocomplete="off"
                class="flex flex-col gap-2 max-w-80"
                @submit.prevent="handleSubmit"
            >
                <div class="flex items-center justify-between">
                    <label for="title">Nombre</label>
                    <input type="text" id="title" v-model="form.name" />
                </div>
                <div class="text-red-600" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
                <div class="mt-4">
                    <h2 class="font-semibold text-lg mb-2">
                        Listado de permisos
                    </h2>

                    <h3 class="font-medium mb-1">Gestionar posts</h3>
                    <hr class="mb-1" />
                    <div class="flex gap-4 mb-4">
                        <div
                            v-for="permission in permissions.filter(
                                (el) => el.for === 'posts'
                            )"
                            class="flex items-center gap-1"
                        >
                            <label class="text-nowrap" :for="permission.id">{{
                                permission.description
                            }}</label>
                            <input
                                type="checkbox"
                                :value="permission.id"
                                :id="permission.id"
                                v-model="form.permissions"
                            />
                        </div>
                    </div>

                    <h3 class="font-medium mb-1">Gestionar usuarios</h3>
                    <hr class="mb-1" />
                    <div class="flex gap-4 mb-4">
                        <div
                            class="flex items-center gap-1"
                            v-for="permission in permissions.filter(
                                (el) => el.for === 'users'
                            )"
                        >
                            <label class="text-nowrap" :for="permission.id">{{
                                permission.description
                            }}</label>
                            <input
                                type="checkbox"
                                :value="permission.id"
                                :id="permission.id"
                                v-model="form.permissions"
                            />
                        </div>
                    </div>

                    <h3 class="font-medium mb-1">Gestionar roles</h3>
                    <hr class="mb-1" />
                    <div class="flex gap-4">
                        <div
                            class="flex items-center gap-1"
                            v-for="permission in permissions.filter(
                                (el) => el.for === 'roles'
                            )"
                        >
                            <label
                                class="text-nowrap text-gray-900"
                                :for="permission.id"
                                >{{ permission.description }}</label
                            >
                            <input
                                type="checkbox"
                                :value="permission.id"
                                :id="permission.id"
                                v-model="form.permissions"
                            />
                        </div>
                    </div>

                    <!-- <div v-for="permission of permissions">
                    
                        <label :for="permission.id">{{
                            permission.description
                        }}</label>
                        <input
                            type="checkbox"
                            :value="permission.id"
                            :id="permission.id"
                            v-model="form.permissions"
                        />
                    </div> -->
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
