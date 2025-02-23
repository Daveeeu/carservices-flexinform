<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchClientRequest;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    protected ClientService $clientService;

    /**
     * Konstruktor, amely injektálja a ClientService-t.
     *
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Ügyfelek listázása.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $clients = $this->clientService->getClients(15);

        return response()->json($clients);
    }

    /**
     * Ügyfél autóinak lekérdezése.
     *
     * @param int $clientId
     * @return JsonResponse
     */
    public function getClientCars(int $clientId): JsonResponse
    {
        $cars = $this->clientService->getClientCars($clientId);
        return response()->json($cars);
    }


    /**
     * Ügyfél keresése validációval és eredmények megjelenítésével.
     *
     * @param SearchClientRequest $request
     * @return JsonResponse
     */
    public function searchClient(SearchClientRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        if (empty($validatedData['name']) && empty($validatedData['card_number'])) {
            return response()->json(['error' => 'Either name or card number must be provided.'], 422);
        }

        if (!empty($validatedData['name']) && !empty($validatedData['card_number'])) {
            return response()->json(['error' => 'Only one field can be filled at a time.'], 422);
        }

        try {
            $client = $this->clientService->findClient($validatedData);

            if ($client === null) {
                return response()->json(['error' => 'No client found.'], 404);
            }

            return response()->json($client);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
