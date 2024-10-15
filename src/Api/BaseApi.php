<?php

namespace CLDT\Aircall\Api;

use Illuminate\Http\Client\PendingRequest;

abstract class BaseApi
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }
}