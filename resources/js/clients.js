import axios from "axios";
import ClientsTable from './components/ClientsTable.vue';
import ClientSearch from './components/ClientSearch/ClientSearch.vue';
import ServiceLogModal from './components/ServiceLogModal/ServiceLogModal.vue';
import Pagination from "./components/Pagination/Pagination.vue";

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
