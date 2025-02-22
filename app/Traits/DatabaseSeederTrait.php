<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

trait DatabaseSeederTrait
{
    /**
     * Ellenőrzi, hogy az adatbázis táblái üresek-e.
     *
     * @return bool
     */
    public function isDatabaseEmpty(): bool
    {
        try {
            return DB::table('clients')->doesntExist() &&
                DB::table('cars')->doesntExist() &&
                DB::table('services')->doesntExist();
        } catch (Exception $e) {
            Log::error('Error checking database tables: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Adatok betöltése az adatbázisba.
     */
    public function seedDatabase()
    {
        try {
            // JSON fájlok beolvasása
            $clientsData = $this->readJsonFile('data/clients.json');
            $carsData = $this->readJsonFile('data/cars.json');
            $servicesData = $this->readJsonFile('data/services.json');

            // Adatok formázása és tömeges beszúrás (bulk insert)
            $this->bulkInsert('clients', $this->transformClients($clientsData));
            $this->bulkInsert('cars', $this->transformCars($carsData));
            $this->bulkInsert('services', $this->transformServices($servicesData));

            Log::info('Database seeding completed successfully.');
        } catch (Exception $e) {
            Log::error('Error during database seeding: ' . $e->getMessage());
        }
    }

    /**
     * JSON fájl beolvasása és dekódolása.
     *
     * @param string $path
     * @return array
     */
    private function readJsonFile(string $path): array
    {
        try {
            $filePath = public_path($path);

            if (!file_exists($filePath)) {
                throw new Exception("JSON file not found: {$filePath}");
            }

            $data = json_decode(file_get_contents($filePath), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON format in file: {$filePath}");
            }

            return $data ?? [];
        } catch (Exception $e) {
            Log::error('Error reading JSON file: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Adatok tömeges beszúrása az adott táblába.
     *
     * @param string $table
     * @param array $data
     */
    private function bulkInsert(string $table, array $data)
    {
        if (empty($data)) {
            Log::warning("No data to insert into table: {$table}");
            return;
        }

        foreach (array_chunk($data, 1000) as $chunk) {
            DB::table($table)->insert($chunk);
        }
    }

    /**
     * Ügyféladatok átalakítása a megfelelő formátumra.
     *
     * @param array $clientsData
     * @return array
     */
    private function transformClients(array $clientsData): array
    {
        return array_map(function ($client) {
            return [
                'id' => (int) ($client['id'] ?? 0),
                'name' => trim($client['name'] ?? ''),
                'card_number' => trim($client['idcard'] ?? ''),
            ];
        }, $clientsData);
    }

    /**
     * Autó adatok átalakítása a megfelelő formátumra.
     *
     * @param array $carsData
     * @return array
     */
    private function transformCars(array $carsData): array
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

    /**
     * Szerviz adatok átalakítása a megfelelő formátumra.
     *
     * @param array $servicesData
     * @return array
     */
    private function transformServices(array $servicesData): array
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

