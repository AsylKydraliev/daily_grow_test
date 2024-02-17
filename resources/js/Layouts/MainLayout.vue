<script setup>
import { Link } from "@inertiajs/vue3";
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
                                :href="route('home')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                            >
                                <img src="../../../public/assets/icon-dashboard.png" alt="analytics" />
                                <span>Dashboard</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <Link
                                :href="route('clients.index')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                            >
                                <img src="../../../public/assets/research.png" alt="analytics" />
                                <span>Клиенты</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <Link
                                :href="route('mailings.index')"
                                class="flex items-center p-2 space-x-3 rounded-md"
                            >
                                <img src="../../../public/assets/chat.png" alt="analytics" />

                                <span>Рассылки</span>
                            </Link>
                        </li>
                        <li class="rounded-sm">
                            <a
                                href="#"
                                class="flex items-center p-2 space-x-3 rounded-md"
                            >
                                <img src="../../../public/assets/analytics.png" alt="analytics" />

                                <span>Аналитика</span>
                            </a>
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
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                                    />
                                </svg>

                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container mt-4 mx-6">
            <slot/>
        </div>
    </div>
</template>
