<script setup>
import { computed, ref } from "vue";
import Skeleton from "@/Components/Skeleton.vue";
import Notification from "@/Components/Notification.vue";

defineProps({
    props: Object
});

const fileInput = ref(null);
const excelData = ref([]);
const responseError = ref(null);
const responseSuccess = ref(null);
const loading = ref(false);

const uploadFile = async () => {
    const files = fileInput.value.files;

    if (files.length > 0) {
        let formData = new FormData();
        formData.append('file', files[0]);

        try {
            loading.value = true;

            const response = await axios.post('/clients/importExcel', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            excelData.value = response.data.clients;
            loading.value = false;
            responseSuccess.value = response.data.message;
            responseError.value = null;
            location.reload();
        } catch (error) {
            loading.value = false;
            fileInput.value.value = null;
            responseError.value = error.response.data.error;
        }
    } else {
        responseError.value = 'Файл не выбран';
    }
}

const hasError = computed(() => {
    return !!responseError.value;
});
</script>

<template>
    <Notification v-if="hasError" color="bg-red-500" :message="responseError"/>
    <Notification v-if="responseSuccess" color="bg-green-500" :message="responseSuccess"/>

    <div class="flex justify-between items-center mb-5">
        <h3 class="text-xl font-bold">Клиенты</h3>

        <div class="flex items-center gap-2">
            <a type="button"
                    href="/DailyGrowClients.xlsx"
                    download="DailyGrowClients.xlsx"
                    class="inline-flex items-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center">
                <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                        d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                    <path
                        d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                </svg>
                Скачать шаблон
            </a>

            <div class="flex items-center gap-2 justify-center">
                <input
                    @input="uploadFile"
                    class="relative w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    type="file"
                    id="file_input"
                    ref="fileInput"
                />
            </div>
        </div>
    </div>

    <Skeleton v-if="loading"/>

    <div v-else class="relative overflow-x-auto mb-6">
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
            <tr v-for="client in excelData" :key="client.id"
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
</template>
