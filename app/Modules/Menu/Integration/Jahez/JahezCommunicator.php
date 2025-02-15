<?php

namespace App\Modules\Menu\Integration\Jahez;

use Illuminate\Support\Facades\Http;

class JahezCommunicator
{
    private array $headers;
    private $url;

    public function __construct()
    {
        $this->url = config('integrate.providers.Jahez.url');
        $this->headers = [
            'Authorization' => "Bearer " . config('integrate.providers.Jahez.auth_token')
        ];
    }

    public function createDeliver($data)
    {
        $url = $this->url . '/create-delivery';
        $response = Http::withHeaders($this->headers)->post($url, $data);
        return json_decode($response->body());
    }
}
