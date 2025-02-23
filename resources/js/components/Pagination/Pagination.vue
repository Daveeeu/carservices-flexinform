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

<script src="./pagination.js"/>
