<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Client;
use App\Models\Service;
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
    public function getClientCars(int $clientId): Collection
    {
        return Car::where('client_id', $clientId)
            ->with(['latestService' => function ($query) use ($clientId) {
                $query->select('car_id', 'event', 'event_time')
                    ->where('client_id', $clientId)
                    ->limit(1);
            }])
            ->get();

    }


    /**
     * Ügyfél keresése név vagy okmányazonosító alapján.
     *
     * @param array $data
     * @return array|null
     */
    public function findClient(array $data): ?array
    {
        if (!empty($data['card_number'])) {
            $client = Client::where('card_number', $data['card_number'])->first();
        } elseif (!empty($data['name'])) {
            $clients = Client::where('name', 'like', '%' . $data['name'] . '%')->get();

            if ($clients->count() > 1) {
                throw new \Exception('Multiple clients found. Please refine your search.');
            }

            $client = $clients->first();
        } else {
            return null;
        }

        if (!$client) {
            return null;
        }

        $carCount = Car::where('client_id', $client->id)->count();
        $serviceCount = Service::where('client_id', $client->id)->count();

        return [
            'id' => $client->id,
            'name' => $client->name,
            'card_number' => $client->card_number,
            'car_count' => $carCount,
            'service_count' => $serviceCount,
        ];
    }
}
