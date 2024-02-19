<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";

defineProps({
    clientsCount: Number,
    mailingsSentCount: Number,
    mailingsDeliveredCount: Number,
});
</script>

<template>
    <MainLayout>
        <h3 class="text-xl font-bold mt-2 mb-5">Статистика</h3>
        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
            <div class="w-full p-10 bg-white rounded-lg shadow">
                <div class="text-xl font-medium text-gray-500 truncate">
                    Количество клиентов
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ clientsCount }}
                </div>
            </div>
            <div class="w-full p-10 bg-white rounded-lg shadow">
                <div class="text-xl font-medium text-gray-500 truncate">
                    Отправленных рассылок
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ mailingsSentCount }}
                </div>
            </div>
            <div class="w-full p-10 bg-white rounded-lg shadow">
                <div class="text-xl font-medium text-gray-500 truncate">
                    Доставленных рассылок
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ mailingsDeliveredCount }}
                </div>
            </div>
        </div>
    </MainLayout>
</template>
