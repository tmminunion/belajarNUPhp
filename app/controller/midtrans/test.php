<?php

use App\Models\CheckSignature;

class Test
{
    public function index()
    {
        $payload = json_decode(file_get_contents('php://input'), true); // Decode JSON to array

        if (json_last_error() !== JSON_ERROR_NONE) {
            res(400, ['message' => 'Invalid JSON payload']);
            return;
        }

        $data["status"] = CheckSignature::isValidSignature($payload);
        res(200, $data);
    }
}
