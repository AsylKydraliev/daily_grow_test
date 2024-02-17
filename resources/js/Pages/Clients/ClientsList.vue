<script setup>
import Pagination from "@/Components/Pagination.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    props: Object
});
</script>

<template>
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-xl font-bold">Список клиентов</h3>

        <div class="flex items-center gap-2 justify-center">
            <Link :href="route('clients.create')"
                  class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Добавить нового клиента
            </Link>
        </div>
    </div>

    <div class="relative overflow-x-auto mb-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ФИО
                </th>
                <th scope="col" class="px-6 py-3">
                    Номер телефона
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Дата рождения
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="client in props.clients.data" :key="client.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ client.name }}
                </th>
                <td class="px-6 py-4">
                    {{ client.phone }}
                </td>
                <td class="px-6 py-4">
                    {{ client.email }}
                </td>
                <td class="px-6 py-4">
                    {{ client.birthday }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <Pagination :links="props.clients.links" class="flex justify-end items-end"/>
</template>
