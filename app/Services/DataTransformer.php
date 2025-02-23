<?php


namespace App\Services;

class DataTransformer
{
    public function transformClients(array $clientsData): array
    {
        return array_map(function ($client) {
            return [
                'id' => (int) ($client['id'] ?? 0),
                'name' => trim($client['name'] ?? ''),
                'card_number' => trim($client['idcard'] ?? ''),
            ];
        }, $clientsData);
    }

    public function transformCars(array $carsData): array
    {
        return array_map(function ($car) {
            return [
                'id' => (int) ($car['id'] ?? 0),
                'client_id' => (int) ($car['client_id'] ?? 0),
                'car_id' => trim($car['car_id'] ?? ''),
                'type' => trim($car['type'] ?? ''),
                'registered' => isset($car['registered']) ? date('Y-m-d H:i:s', strtotime($car['registered'])) : null,
                'ownbrand' => (bool) ($car['ownbrand'] ?? false),
                'accidents' => (int) ($car['accident'] ?? 0),
            ];
        }, $carsData);
    }

    public function transformServices(array $servicesData): array
    {
        return array_map(function ($service) {
            return [
                'id' => (int) ($service['id'] ?? 0),
                'client_id' => (int) ($service['client_id'] ?? 0),
                'car_id' => (int) ($service['car_id'] ?? 0),
                'log_number' => (int) ($service['lognumber'] ?? 0),
                'event' => trim($service['event'] ?? ''),
                'event_time' => !empty($service['eventtime'])
                    ? date('Y-m-d H:i:s', strtotime($service['eventtime']))
                    : null,
                'document_id' => trim($service['document_id'] ?? ''),
            ];
        }, $servicesData);
    }
}
