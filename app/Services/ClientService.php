<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

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
}
