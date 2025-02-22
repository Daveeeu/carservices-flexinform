<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Lekérdezi az adott autó szerviznaplóját.
     *
     * @param int $clientId Az ügyfél egyedi azonosítója.
     * @param int $carId Az autó egyedi azonosítója (az ügyfélhez tartozó).
     * @return JsonResponse
     */
    public function getClientCarServices(int $clientId, int $carId): JsonResponse
    {
        try {
            $services = $this->carService->getCarServices($clientId, $carId);
            return response()->json($services);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
