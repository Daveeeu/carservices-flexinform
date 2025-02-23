import axios from "axios";
import ClientsTable from './components/ClientsTable.vue';
import ClientSearch from './components/ClientSearch.vue';
import ServiceLogModal from './components/ServiceLogModal.vue';
import Pagination from "./components/Pagination.vue";

export default {
    components: {
        Pagination,
        ClientsTable,
        ServiceLogModal,
        ClientSearch
    },
    data() {
        return {
            clients: [],
            pagination: {},
            baseUrl: "/api/clients",
            expandedClientId: null,
            selectedClientCars: [],
            selectedCarServices: [],
            isModalOpen: false,
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
        async fetchClientCars(clientId) {
            try {
                const response = await axios.get(`/api/clients/${clientId}/cars`);
                this.selectedClientCars = response.data;
            } catch (error) {
                console.error("Error fetching client cars:", error);
            }
        },
        async fetchClientCarServices(carId) {
            try {
                let clientId = this.expandedClientId;
                const response = await axios.get(`/api/clients/${clientId}/cars/${carId}/services`);
                this.selectedCarServices = response.data;
                this.isModalOpen = true;

            } catch (error) {
                console.error("Error fetching client cars:", error);
            }
        },
        async toggleClientCars(clientId) {
            if (this.expandedClientId === clientId) {
                this.expandedClientId = null;
                this.selectedClientCars = [];
            } else {
                this.expandedClientId = clientId;
                await this.fetchClientCars(clientId);
            }
        },
        closeModal(){
            this.isModalOpen = false;
        },
    },
};
