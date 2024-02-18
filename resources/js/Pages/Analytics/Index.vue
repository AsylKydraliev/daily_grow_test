<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { ref, watch } from "vue";
import { router } from '@inertiajs/vue3';

const props = defineProps({
    mailingAnalytics: Object,
    sentCount: Number,
    deliveredCount: Number,
});

const selectedDate = ref('');
const period = ref('');

const filter = (data) => {
    router.get('/analytics', data, {
        preserveState: true,
        replace: true
    });
};

const filterByDate = (value) => {
    filter({ date: value });
};

const filterByPeriod = (value) => {
    filter({ period: value });
};

watch(selectedDate, value => {
    filterByDate(value);
});

watch(period, value => {
    filterByPeriod(value);
});
</script>

<template>
    <MainLayout>
        <div class="mb-5 mt-2">
            <h3 class="text-xl font-bold">Аналитика по рассылкам</h3>
        </div>

        <hr>

        <div class="flex gap-3 items-center my-5">
            <input
                type="date"
                id="selectedDate"
                name="selectedDate"
                v-model="selectedDate"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Выберите дату"
            />
            <button
                @click="period = 'week'"
                class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                7 дней
            </button>
            <button
                @click="period = '30days'"
                class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                30 дней
            </button>
            <button
                @click="period = 'month'"
                class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                месяц
            </button>
            <button
                @click="period = 'quarter'"
                class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                квартал
            </button>
            <button
                @click="period = 'year'"
                class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                год
            </button>
        </div>

        <div class="relative overflow-x-auto mb-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 size-1.5">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Название
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Статус
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Отправлено
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Доставлено
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="mailingAnalytics.length" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                        Итого
                    </th>
                    <td class="px-6 py-4">
                    </td>
                    <td class="px-6 py-4">
                    </td>
                    <td class="px-6 py-4 font-bold text-black">
                        {{ sentCount }}
                    </td>
                    <td class="px-6 py-4 font-bold text-black">
                        {{ deliveredCount }}
                    </td>
                </tr>

                <tr v-for="mailingAnalytic in mailingAnalytics" :key="mailingAnalytic.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ mailingAnalytic.id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ mailingAnalytic.name }}
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="bg-green-300 text-gray-600 text-xs font-medium me-2 px-4 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                    {{ mailingAnalytic.status ?? 'Работает' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ mailingAnalytic.sent_count ?? 0 }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mailingAnalytic.delivered_count ?? 0 }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </MainLayout>
</template>
