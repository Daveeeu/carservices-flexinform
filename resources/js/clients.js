import axios from "axios";

export default {
    data() {
        return {
            clients: [],
            pagination: {},
            baseUrl: "/api/clients",
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.pagination.total / this.pagination.per_page);
        },
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
    },
    mounted() {
        this.fetchClients(this.baseUrl);
    },
    methods: {
        async fetchClients(url) {
            try {
                const response = await axios.get(url);
                this.clients = response.data.data;
                this.pagination = response.data;
            } catch (error) {
                console.error("Error fetching clients:", error);
            }
        },
    },
};
