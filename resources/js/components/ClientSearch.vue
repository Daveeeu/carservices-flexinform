<template>
    <div>
        <form @submit.prevent="handleSubmit" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Client Name</label>
                    <input
                        type="text"
                        id="name"
                        v-model="name"
                        class="form-control"
                        placeholder="Enter client name"
                    />
                </div>

                <div class="col-md-6">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input
                        type="text"
                        id="cardNumber"
                        v-model="cardNumber"
                        class="form-control"
                        placeholder="Enter card number"
                    />
                </div>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Search</button>
                <button
                    v-if="isSearching || clients.length > 0"
                    type="button"
                    @click="clearSearch"
                    class="btn btn-secondary"
                >
                    Clear Search
                </button>
            </div>

            <div v-if="errorMessage" class="alert alert-danger mt-3">
                {{ errorMessage }}
            </div>
        </form>

        <div v-if="clients.length > 0" class="mt-4">
            <h5>Search Results</h5>
            <div
                v-for="client in clients"
                :key="client.id"
                class="p-3 border rounded mb-3 bg-light"
            >
                <p><strong>ID:</strong> {{ client.id }}</p>
                <p><strong>Name:</strong> {{ client.name }}</p>
                <p><strong>Card Number:</strong> {{ client.card_number }}</p>
                <p><strong>Number of Cars:</strong> {{ client.car_count }}</p>
                <p><strong>Total Service Records:</strong> {{ client.service_count }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            cardNumber: '',
            errorMessage: '',
            clients: [],
            isSearching: false,
        };
    },
    methods: {
        async handleSubmit() {
            if (!this.name && !this.cardNumber) {
                this.errorMessage = 'Either name or card number must be provided.';
                return;
            }

            if (this.name && this.cardNumber) {
                this.errorMessage = 'Only one field can be filled at a time.';
                return;
            }

            if (this.cardNumber && !/^[a-zA-Z0-9]+$/.test(this.cardNumber)) {
                this.errorMessage = 'Card number must contain only letters and numbers.';
                return;
            }

            this.errorMessage = '';
            const searchParams = {name: this.name, card_number: this.cardNumber};

            await this.handleSearch(searchParams);
        },
        async handleSearch(searchParams) {
            try {
                const response = await axios.post('/api/clients/search', searchParams);

                this.clients = [response.data];
                this.isSearching = true;
            } catch (error) {
                console.error(error.response?.data?.error || 'Error searching for client.');
                this.errorMessage =
                    error.response?.data?.error || 'An unexpected error occurred while searching.';
                this.clients = [];
            }
        },
        clearSearch() {
            this.name = '';
            this.cardNumber = '';
            this.errorMessage = '';
            this.clients = [];
            this.isSearching = false;
        },
    },
};
</script>

<style scoped>
.form-label {
    font-weight: bold;
}

.alert {
    font-size: 0.9rem;
}

.border {
    background-color: #f9f9f9;
}
</style>
