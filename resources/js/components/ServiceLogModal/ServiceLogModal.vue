<template>
    <div
        class="modal-backdrop d-flex justify-content-center align-items-center"
        v-if="services && services.length > 0"
    >
        <div class="modal-dialog modal-lg z-3">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        Service Log for Car ID: {{ carId }} | Client ID: {{ clientId }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="$emit('close-modal')"
                        aria-label="Close"
                    ></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th>Log Number</th>
                            <th>Event</th>
                            <th>Event Time</th>
                            <th>Document ID</th>
                        </tr>
                        </thead>
                        <tbody v-if="paginatedServices.length > 0">
                        <tr v-for="service in paginatedServices" :key="service.log_number">
                            <td>{{ service.log_number }}</td>
                            <td>{{ service.event }}</td>
                            <td>{{ service.event_time || "N/A" }}</td>
                            <td>{{ service.document_id }}</td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No service logs available for this car.
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div v-if="services.length > pageSize" class="d-flex justify-content-center mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li
                                    class="page-item"
                                    :class="{ disabled: currentPage === 1 }"
                                >
                                    <button
                                        class="page-link"
                                        @click="changePage(currentPage - 1)"
                                    >
                                        Previous
                                    </button>
                                </li>
                                <li
                                    class="page-item"
                                    v-for="page in totalPages"
                                    :key="'page-' + page"
                                    :class="{ active: currentPage === page }"
                                >
                                    <button
                                        class="page-link"
                                        @click="changePage(page)"
                                    >
                                        {{ page }}
                                    </button>
                                </li>
                                <li
                                    class="page-item"
                                    :class="{ disabled: currentPage === totalPages }"
                                >
                                    <button
                                        class="page-link"
                                        @click="changePage(currentPage + 1)"
                                    >
                                        Next
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="$emit('close-modal')"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script src="./serviceLogModal.js"/>
