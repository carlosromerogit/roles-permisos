<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
defineOptions({ layout: AuthenticatedLayout });
defineProps({
    users: Array,
});
</script>
<template>
    <div>
        <div
            class="flex items-center justify-between pb-1 mb-2 border-b border-gray-200"
        >
            <div>
                <h2 class="text-2xl font-semibold">Listado de usuarios</h2>
            </div>
            <div>
                <Link
                    href="/dashboard/usuarios/crear"
                    class="bg-gray-800 text-white px-4 py-2 rounded"
                    as="button"
                >
                    Crear usuario
                </Link>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table
                    class="w-full text-left rtl:text-right text-gray-400 dark:text-gray-400"
                >
                    <thead
                        class="text-sm font-bold text-gray-900 uppercase bg-gray-200"
                    >
                        <tr>
                            <th scope="col" class="px-2 py-3">Nombre</th>
                            <th scope="col" class="px-2 py-3">Email</th>
                            <th scope="col" class="px-2 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="user of users"
                            class="border-b border-gray-300"
                        >
                            <th
                                scope="row"
                                class="px-3 py-4 text-gray-600 font-semibold"
                            >
                                {{ user.name }}
                            </th>
                            <td class="px-3 py-4 text-gray-600 font-semibold">
                                {{ user.email }}
                            </td>
                            <td
                                class="px-3 py-4 text-gray-600 font-semibold space-x-1"
                            >
                                <Link
                                    :href="`/dashboard/usuarios/${user.id}/editar`"
                                    class="p-1 bg-gray-300 rounded hover:bg-gray-400"
                                    as="button"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-pencil-square"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
                                        />
                                    </svg>
                                </Link>
                                <Link
                                    as="button"
                                    method="delete"
                                    :href="`/dashboard/usuarios/${user.id}`"
                                    class="p-1 bg-red-500 rounded hover:bg-red-600"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-trash"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"
                                        />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"
                                        />
                                    </svg>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
