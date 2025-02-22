<template>
    <div class="modal-backdrop" v-if="services && services.length > 0">
        <div class="modal-dialog modal-lg z-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Log</h5>
                    <button type="button" class="btn-close" @click="$emit('close-modal')"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>Log Number</th>
                            <th>Event</th>
                            <th>Event Time</th>
                            <th>Document ID</th>
                        </tr>
                        </thead>
<!--                        TODO túl sok a log akkor itt is legyen pagination-->
                        <tbody v-if="services.length > 0">
                        <tr v-for="service in services" :key="service.log_number">
                            <td>{{ service.log_number }}</td>
                            <td>{{ service.event }}</td>
                            <td>{{ service.event_time || "N/A" }}</td>
                            <td>{{ service.document_id }}</td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr><td colspan="4" class="text-center">No service logs available for this car.</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close-modal')">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        services: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped></style>
