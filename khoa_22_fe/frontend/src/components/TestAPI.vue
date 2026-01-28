<template>
    <div class="p-4">
        <h3>Test API Connection</h3>
        <button @click="testAPI" class="btn btn-primary">Test API</button>
        <hr>
        <div v-if="loading" class="alert alert-info">Loading...</div>
        <div v-if="error" class="alert alert-danger">{{ error }}</div>
        <div v-if="data" class="alert alert-success">
            <strong>Success!</strong>
            <pre>{{ JSON.stringify(data, null, 2) }}</pre>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'TestAPI',
    data() {
        return {
            loading: false,
            error: null,
            data: null
        }
    },
    methods: {
        testAPI() {
            this.loading = true;
            this.error = null;
            this.data = null;

            console.log('Testing API with axios config:', {
                baseURL: axios.defaults.baseURL,
                headers: axios.defaults.headers.common
            });

            axios.get('/api/admin/phim/get-data')
                .then((response) => {
                    console.log('API response:', response);
                    this.data = response.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.error('API error:', error);
                    this.error = error.message + ' - ' + (error.response?.statusText || '');
                    if (error.response?.data) {
                        this.error += ' - ' + JSON.stringify(error.response.data);
                    }
                    this.loading = false;
                });
        }
    },
    mounted() {
        console.log('TestAPI component mounted');
    }
}
</script>

<style scoped>
pre {
    background: #f5f5f5;
    padding: 10px;
    border-radius: 4px;
    max-height: 300px;
    overflow-y: auto;
}
</style>
