<template>
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th>Car ID</th>
            <th>Type</th>
            <th>Registered</th>
            <th>Own Brand</th>
            <th>Accidents</th>
            <th>Latest Service</th>
            <th>Service Time</th>
        </tr>
        </thead>
        <tbody v-if="cars.length > 0">
        <tr
            v-for="car in cars"
            :key="car.car_id">
            <td class="clickable" @click="$emit('fetch-car-services', car.car_id)">{{ car.car_id }}</td>
            <td>{{ car.type }}</td>
            <td>{{ car.registered }}</td>
            <td>{{ car.ownbrand ? "Yes" : "No" }}</td>
            <td>{{ car.accidents }}</td>
            <td>{{ car.latestService?.event || "N/A" }}</td>
            <td>{{ car.latestService?.event_time || "N/A" }}</td>
        </tr>
        </tbody>

        <!-- No Cars Message -->
        <tbody v-else>
        <tr><td colspan="7" class="text-center">No cars available for this client.</td></tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        cars: Array,
    },
};
</script>
