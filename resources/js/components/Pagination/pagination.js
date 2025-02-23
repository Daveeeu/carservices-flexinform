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
