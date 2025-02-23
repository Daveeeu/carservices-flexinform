<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Exception;

class JsonFileReader
{
    /**
     * JSON fájl beolvasása és dekódolása.
     *
     * @param string $path
     * @return array
     * @throws Exception
     */
    public function read(string $path): array
    {
        $filePath = public_path($path);

        if (!file_exists($filePath)) {
            throw new Exception("JSON file not found: {$filePath}");
        }

        $data = json_decode(file_get_contents($filePath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON format in file: {$filePath}");
        }

        return $data ?? [];
    }
}
