<script setup>
import Pagination from "@/Components/Pagination.vue";
import {Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";

defineProps({
    props: Object
});

const search = ref('');

const onSearch = (value) => {
    router.get('/clients', { search: value }, {
        preserveState: true,
        replace: true
    });
};

watch(search, value => {
    onSearch(value);
});
</script>

<template>
    <div class="relative my-3">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input
            type="search"
            id="search"
            v-model="search"
            class="block w-full py-2.5 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Поиск и фильтр"
            required
        />
    </div>

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
