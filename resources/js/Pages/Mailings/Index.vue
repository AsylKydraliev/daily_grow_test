<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    mailings: Object,
});
</script>

<template>
    <MainLayout>
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold">Рассылки</h3>

            <div class="flex items-center gap-2 justify-center">
                <Link :href="route('mailings.create')"
                      class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Создать рассылку
                </Link>
            </div>
        </div>

        <div class="relative overflow-x-auto mb-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Название
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Текст рассылки
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="mailing in mailings.data" :key="mailing.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ mailing.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ mailing.message }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="mailings.links" class="flex justify-end items-end"/>
    </MainLayout>
</template>
