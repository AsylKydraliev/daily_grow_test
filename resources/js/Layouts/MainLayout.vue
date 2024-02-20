<script setup>
import {Link, router} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import {ref} from "vue";

const currentUrl = ref(router.page.url);
</script>

<template>
    <div class="flex">
        <div class="flex flex-col h-screen p-3 bg-white shadow w-60">
            <div class="space-y-3">
                <div class="flex items-center">
                    <img src="../../../public/assets/logo.png" alt="Daily Grow"/>
                </div>

                <div class="flex-1">
                    <ul class="pt-2 pb-4 space-y-1 text-sm">
                        <li class="rounded-sm">
                            <Link
                                :href="route('dashboard')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                                :class="{ 'active': currentUrl === '/dashboard' }"
                            >
                                <img src="../../../public/assets/icon-dashboard.png" alt="dashboard"/>
                                <span>Dashboard</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <Link
                                :href="route('clients.index')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                                :class="{ 'active': currentUrl === '/clients' }"
                            >
                                <img src="../../../public/assets/research.png" alt="clients"/>
                                <span>Клиенты</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <Link
                                :href="route('mailings.index')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                                :class="{ 'active': currentUrl === '/mailings' }"
                            >
                                <img src="../../../public/assets/chat.png" alt="mailings"/>

                                <span>Рассылки</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <Link
                                :href="route('mailings.analytics')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                                :class="{ 'active': currentUrl === '/analytics' }"
                            >
                                <img src="../../../public/assets/analytics.png" alt="analytics"/>

                                <span>Аналитика</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <a
                                href="#"
                                class="flex items-center p-2 space-x-3 rounded-md"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="#C7C7C7"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                                    />
                                </svg>

                                <span>Выйти</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <Dropdown align="right" class="text-right my-4">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                            {{ $page.props.auth.user.name }}

                            <svg
                                class="ms-2 -me-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </DropdownLink>
                </template>
            </Dropdown>

            <div class="container mt-4 mx-6 block">
                <slot/>
            </div>
        </div>
    </div>
</template>

<style scoped>
.active {
    background: whitesmoke;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0;
    color: #1e53c7;
    font-weight: 600;
}
</style>
