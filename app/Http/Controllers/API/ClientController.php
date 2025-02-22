<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
}
