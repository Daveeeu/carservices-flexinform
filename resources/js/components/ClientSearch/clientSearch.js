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
