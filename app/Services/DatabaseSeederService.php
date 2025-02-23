<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DatabaseSeederService
{
    private JsonFileReader $fileReader;
    private DataTransformer $transformer;

    public function __construct(JsonFileReader $fileReader, DataTransformer $transformer)
    {
        $this->fileReader = $fileReader;
        $this->transformer = $transformer;
    }

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
    public function seedDatabase(): void
    {
        try {
            // JSON fájlok beolvasása
            $clientsData = $this->fileReader->read('data/clients.json');
            $carsData = $this->fileReader->read('data/cars.json');
            $servicesData = $this->fileReader->read('data/services.json');

            // Adatok formázása és tömeges beszúrás
            DB::table('clients')->insert($this->transformer->transformClients($clientsData));
            DB::table('cars')->insert($this->transformer->transformCars($carsData));
            DB::table('services')->insert($this->transformer->transformServices($servicesData));

            Log::info('Database seeding completed successfully.');
        } catch (Exception $e) {
            Log::error('Error during database seeding: ' . $e->getMessage());
        }
    }
}
