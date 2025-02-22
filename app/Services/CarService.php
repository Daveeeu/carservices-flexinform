<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Service;
use Illuminate\Support\Collection;

class CarService
{
    /**
     * Lekérdezi az adott autó szerviznaplóját.
     *
     * @param int $clientId
     * @param int $carId
     * @return Collection
     */
    public function getCarServices(int $clientId, int $carId): Collection
    {
        // Ellenőrizzük, hogy létezik-e az autó az adott ügyfélhez
        $car = Car::where('client_id', $clientId)
            ->where('car_id', $carId)
            ->firstOrFail();

        // Lekérjük a szerviznapló bejegyzéseket
        return Service::query()
            ->where('client_id', $clientId)
            ->where('car_id', $carId)
            ->get()
            ->map(function ($service) use ($car) {
                if ($service->event === 'regisztralt') {
                    $service->event_time = $car->registered;
                }
                return $service;
            });
    }
}
