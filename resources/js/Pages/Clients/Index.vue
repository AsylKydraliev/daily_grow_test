<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ClientsList from "@/Pages/Clients/ClientsList.vue";
import ClientsImport from "@/Pages/Clients/ClientsImport.vue";
import TabsComponent from "@/Components/TabsComponent.vue";

const props = defineProps({
    clients: Object,
});

const tabs = ['Список клиентов', 'Загрузка клиентов'];

const tabComponents = [
    {
        name: ClientsList,
        props: {
            clients: props.clients
        }
    },
    {
        name: ClientsImport,
        props: null
    },
];
</script>

<template>
    <MainLayout>
        <TabsComponent
            :tabs="tabs"
            :tabComponents="tabComponents"
        ></TabsComponent>
    </MainLayout>
</template>
