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

<script src="./clientSearch.js"/>
<style src="./clientSearch.css"></style>

