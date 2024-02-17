<script setup>
import {computed, ref} from "vue";
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
    <Notification v-if="hasError" color="bg-red-500" :message="responseError" />
    <Notification v-if="responseSuccess" color="bg-green-500" :message="responseSuccess" />

    <div class="flex justify-between items-center mb-5">
        <h3 class="text-xl font-bold">Клиенты</h3>

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

    <Skeleton v-if="loading" />

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
