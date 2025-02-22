<template>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Clients</h1>
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
                <!-- Ügyfél sora -->
                <tr>
                    <td>{{ client.id }}</td>
                    <td @click="toggleClientCars(client.id)" style="cursor: pointer; color: blue;">
                        {{ client.name }}
                    </td>
                    <td>{{ client.card_number }}</td>
                </tr>


                <!-- Autók táblázata az ügyfél sora alatt -->
                <tr v-if="expandedClientId === client.id">
                    <template v-if="selectedClientCars.length === 0">
                        <td colspan="7" class="text-center">No cars available for this client.</td>
                    </template>

                    <template v-if="selectedClientCars.length !== 0">
                        <td colspan="3">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Car ID</th>
                                    <th>Type</th>
                                    <th>Registered</th>
                                    <th>Own Brand</th>
                                    <th>Accidents</th>
                                    <th>Last Event</th>
                                    <th>Last Event Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="car in selectedClientCars" :key="car.id">
                                    <td>{{ car.car_id }}</td>
                                    <td>{{ car.type }}</td>
                                    <td>{{ car.registered }}</td>
                                    <td>{{ car.ownbrand ? "Yes" : "No" }}</td>
                                    <td>{{ car.accidents }}</td>
                                    <td>{{ car.latestService?.event || "N/A" }}</td>
                                    <td>{{ car.latestService?.event_time || "N/A" }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </template>
                </tr>
            </template>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation" v-if="pagination.total > pagination.per_page">
            <ul class="pagination justify-content-center">
                <!-- First Page -->
                <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                    <button class="page-link" @click="fetchClients(pagination.first_page_url)">First</button>
                </li>

                <!-- Previous Page -->
                <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                    <button class="page-link" @click="fetchClients(pagination.prev_page_url)">Previous</button>
                </li>

                <!-- Dynamic Page Numbers -->
                <li
                    v-for="page in visiblePages"
                    :key="page"
                    class="page-item"
                    :class="{ active: page === pagination.current_page }">
                    <button class="page-link" @click="fetchClients(`${baseUrl}?page=${page}`)">{{ page }}</button>
                </li>

                <!-- Next Page -->
                <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                    <button class="page-link" @click="fetchClients(pagination.next_page_url)">Next</button>
                </li>

                <!-- Last Page -->
                <li class="page-item" :class="{ disabled: pagination.current_page === totalPages }">
                    <button class="page-link" @click="fetchClients(`${baseUrl}?page=${totalPages}`)">Last</button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script src="../clients.js"></script>

<style src="../../css/clients.css"></style>

