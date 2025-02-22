<template>
    <nav aria-label="Page navigation" v-if="pagination.total > pagination.per_page">
        <ul class="pagination justify-content-center">
            <!-- First Page -->
            <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                <button class="page-link" @click="$emit('fetch-clients', pagination.first_page_url)">
                    First
                </button>
            </li>

            <!-- Previous Page -->
            <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                <button class="page-link" @click="$emit('fetch-clients', pagination.prev_page_url)">
                    Previous
                </button>
            </li>

            <!-- Dynamic Page Numbers -->
            <li
                v-for="page in visiblePages"
                :key="page"
                class="page-item"
                :class="{ active: page === pagination.current_page }"
            >
                <button class="page-link" @click="$emit('fetch-clients', `${baseUrl}?page=${page}`)">
                    {{ page }}
                </button>
            </li>

            <!-- Next Page -->
            <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                <button class="page-link" @click="$emit('fetch-clients', pagination.next_page_url)">
                    Next
                </button>
            </li>

            <!-- Last Page -->
            <li class="page-item" :class="{ disabled: pagination.current_page === totalPages }">
                <button class="page-link" @click="$emit('fetch-clients', `${baseUrl}?page=${totalPages}`)">
                    Last
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        pagination: Object,
        baseUrl: String,
    },
    computed: {
        visiblePages() {
            const current = this.pagination.current_page;
            const total = this.totalPages;

            let start = Math.max(1, current - 2);
            let end = Math.min(total, current + 2);

            if (current <= 3) {
                end = Math.min(total, 5);
            }

            if (current >= total - 2) {
                start = Math.max(1, total - 4);
            }

            return Array.from({ length: end - start + 1 }, (_, i) => start + i);
        },
        totalPages() {
            return Math.ceil(this.pagination.total / this.pagination.per_page);
        },
    },
};
</script>

<style scoped></style>
