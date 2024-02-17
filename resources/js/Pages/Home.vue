<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
</script>

<template>
    <MainLayout>
        <h3 class="text-xl font-bold">Dashboard</h3>
        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
            <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                <div class="text-sm font-medium text-gray-500 truncate">
                    Total users
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    12,00
                </div>
            </div>
            <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                <div class="text-sm font-medium text-gray-500 truncate">
                    Total Profit
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    $ 450k
                </div>
            </div>
            <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                <div class="text-sm font-medium text-gray-500 truncate">
                    Total Orders
                </div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    20k
                </div>
            </div>
        </div>
    </MainLayout>
</template>
