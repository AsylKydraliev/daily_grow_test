<script>
import {ref} from 'vue';

export default {
    props: {
        tabs: {
            type: Array,
            required: true
        },
        initialTab: {
            type: Number,
            default: 0,
            required: false
        },
        tabComponents: {
            type: Array,
            required: true
        },
    },
    setup(props) {
        const activeTab = ref(props.initialTab);

        const setActiveTab = (index) => {
            activeTab.value = index;
        };

        return {
            activeTab,
            setActiveTab
        };
    }
};
</script>

<template>
    <div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <button
                v-for="(tab, index) in tabs"
                :key="index"
                class="inline-block p-4 rounded-t-lg"
                :class="{ 'text-blue-600 border-b border-blue-600': activeTab === index }"
                @click="setActiveTab(index)"
            >
                {{ tab }}
            </button>
        </div>

        <div
            v-show="activeTab === index"
            v-for="(tabComponent, index) in tabComponents"
            :key="index"
        >
            <keep-alive>
                <component :is="tabComponent.name" :props="tabComponent.props"></component>
            </keep-alive>
        </div>
    </div>
</template>
