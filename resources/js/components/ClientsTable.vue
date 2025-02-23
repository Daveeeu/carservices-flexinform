<template>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Card Number</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="client in clients" :key="client.id">
            <!-- Client Row -->
            <tr :class="{ 'table-primary': expandedClientId === client.id }">
                <td>{{ client.id }}</td>
                <td @click="$emit('toggle-client-cars', client.id)" class="clickable">
                    {{ client.name }}
                </td>
                <td>{{ client.card_number }}</td>
            </tr>

            <!-- Cars Table -->
            <tr v-if="expandedClientId === client.id">
                <td colspan="3">
                    <CarsTable
                        :cars="selectedClientCars"
                        @fetch-car-services="$emit('fetch-client-car-services', $event)"
                    />
                </td>
            </tr>
        </template>
        </tbody>
    </table>
</template>

<script>
import CarsTable from './CarsTable.vue';

export default {
    props: {
        clients: Array,
        expandedClientId: Number,
        selectedClientCars: Array,
    },
    components: {
        CarsTable,
    },
};
</script>

<style scoped></style>
