<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ClientService
{
    /**
     * Ügyfelek lekérdezése lapozással.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getClients(int $perPage = 15): LengthAwarePaginator
    {
        return Client::query()
            ->select('id', 'name', 'card_number')
            ->paginate($perPage);
    }

    /**
     * Lekérdezi az adott ügyfélhez tartozó összes autót, valamint az autókhoz tartozó legutolsó szerviznapló bejegyzéseket.
     *
     * @param int $clientId
     * @return Collection
     */
    public function getClientCars($clientId): Collection
    {
        return Car::where('client_id', $clientId)
            ->with(['latestService' => function ($query) {
                $query->select('car_id', 'event', 'event_time')
                    ->orderBy('log_number', 'desc')
                    ->limit(1);
            }])
            ->get();

    }
}
