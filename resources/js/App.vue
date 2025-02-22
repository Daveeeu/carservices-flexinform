<template>
    <div id="app">
        <Clients />
    </div>
</template>

<script>
import Clients from './pages/Clients.vue';

export default {
    name: 'App',
    components: {
        Clients,
    },
};
</script>

<style>
body {
    font-family: Arial, sans-serif;
}
</style>
