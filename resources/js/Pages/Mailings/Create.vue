<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    message: null,
})

const handleSubmit = async () => {
    form.post('/mailings');
};
</script>

<template>
    <MainLayout>
        <h3 class="text-xl font-bold mb-5">Создать рассылку</h3>
        <form class="sm:max-w-lg" @submit.prevent="handleSubmit">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название рассылки</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    :class="{ 'border-red-500': form.errors.name }"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="С днем рождения 20%"
                />
                <small v-if="form.errors.name" class="text-red-600">{{ form.errors.name }}</small>
            </div>
            <div class="mb-5">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст рассылки</label>
                <textarea
                    id="message"
                    rows="4"
                    v-model="form.message"
                    :class="{ 'border-red-500': form.errors.message }"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="День рождения в СПК со скидкой 20% https://clck.ru/38aqr9"
                ></textarea>
                <small v-if="form.errors.message" class="text-red-600">{{ form.errors.message }}</small>
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Сохранить
            </button>
        </form>
    </MainLayout>
</template>
