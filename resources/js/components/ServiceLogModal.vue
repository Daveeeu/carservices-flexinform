<template>
    <div class="modal-backdrop" v-if="services && services.length > 0">
        <div class="modal-dialog modal-lg z-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Log</h5>
                    <button type="button" class="btn-close" @click="$emit('close-modal')"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered">
                        <thead>
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
                        <tr><td colspan="4" class="text-center">No service logs available for this car.</td></tr>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div v-if="services.length > pageSize" class="d-flex justify-content-start mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                    <button class="page-link" @click="changePage(currentPage - 1)">Previous</button>
                                </li>
                                <li
                                    class="page-item"
                                    v-for="page in totalPages"
                                    :key="page"
                                    :class="{ active: currentPage === page }"
                                >
                                    <button class="page-link" @click="changePage(page)">{{ page }}</button>
                                </li>
                                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                    <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close-modal')">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        services: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            currentPage: 1,
            pageSize: 5,
        };
    },
    computed: {
        paginatedServices() {
            const start = (this.currentPage - 1) * this.pageSize;
            const end = start + this.pageSize;
            return this.services.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.services.length / this.pageSize);
        },
    },
    methods: {
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },
    },
};
</script>

<style scoped></style>
