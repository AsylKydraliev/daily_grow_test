<script setup>
import {onMounted, ref} from 'vue';

const props = defineProps({
    color: {
        type: String,
        default: 'bg-white'
    },
    message: {
        type: String,
        default: 'Something went wrong'
    }
});

const showToast = ref(true);

const showAndHideToast = () => {
    showToast.value = true;
    setTimeout(() => {
        hideToast();
    }, 5000);
};

const hideToast = () => {
    showToast.value = false;
};

onMounted(() => {
    showAndHideToast();
});
</script>

<template>
    <transition name="fade">
        <div v-if="showToast" id="toast-default"
             class="toast flex items-center w-full max-w-md p-4 text-gray-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
             role="alert"
             :class="[color]"
        >
            <div class="ms-3 text-sm font-normal">{{ message }}</div>
            <button type="button" @click="hideToast"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </transition>
</template>

<style scoped>
.toast {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    transition: 0.3s;
}
</style>
