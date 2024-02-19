<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    mailings: Object,
    activeMailing: Object,
});

const selectMailing = (mailing) => {
    router.post('/mailings/setActive/' + mailing.id);
};
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

        <div
            class="block max-w-lg p-4 bg-white border mb-4 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <p class="font-normal text-gray-700 dark:text-gray-400">
                Выберите активную рассылку для отправки вашим клиентам
            </p>
        </div>

        <div class="relative overflow-x-auto mb-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        Активная
                    </th>
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
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input
                                type="radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                :id="'radio-' + mailing.id"
                                name="selectMailing"
                                :checked="mailing.id === activeMailing.id"
                                @click="selectMailing(mailing)"
                            />
                        </div>
                    </td>
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
