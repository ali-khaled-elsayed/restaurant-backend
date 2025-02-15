<?php

return [
    'providers' => [
        'Jahez' => [
            "auth_token" => env('Jahez_TOKEN'),
            "url" => '',
            "service" =>  App\Modules\Menu\Integration\Jahez\JahezService::class
        ],
        'Uber_Eats' => [
            "auth_token" => env('Uber_Eats_TOKEN'),
            "url" => '',
            "service" =>''
        ],
        'Door_Dash' => [
            "auth_token" => env('Door_Dash_TOKEN'),
            "url" => '',
            "service" => ''
        ]
    ],
];
