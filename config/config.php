<?php

/*
 * Aircall API Configuration
 * https://developer.aircall.io/api-references/#basic-auth-aircall-customers
 */
return [
    'endpoint' => env('AIRCALL_ENDPOINT', 'https://api.aircall.io/v1'),
    'api_id' => env('AIRCALL_API_ID', ''),
    'api_token' => env('AIRCALL_API_TOKEN', ''),
];