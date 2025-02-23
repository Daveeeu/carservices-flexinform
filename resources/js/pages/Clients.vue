<template>
    <div class="container mt-5">
        <ClientSearch
            :isSearching="isSearching"
            @search="handleSearch"
            @clearSearch="clearSearch"
        />
        <h1 class="text-center mb-4">Clients</h1>

        <ClientsTable
            :clients="clients"
            :expanded-client-id="expandedClientId"
            :selected-client-cars="selectedClientCars"
            @toggle-client-cars="toggleClientCars"
            @fetch-client-car-services="fetchClientCarServices"
        />


        <!-- Pagination -->
        <Pagination
            :pagination="pagination"
            :base-url="baseUrl"
            @fetch-clients="fetchClients"
        />

        <ServiceLogModal
            v-if="isModalOpen"
            :services="selectedCarServices"
            @close-modal="closeModal"
        />


    </div>

</template>

<script src="../clients.js"></script>

<style src="../../css/clients.css"></style>
