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
