<?php

namespace CLDT\LaravelAircall;

use Illuminate\Http\Client\PendingRequest;
use CLDT\Aircall\Api\Teams;
use CLDT\Aircall\Api\Users;
use CLDT\Aircall\Api\Calls;

class Aircall
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    public function users(): Users
    {
        return new Users($this->client);
    }

    public function teams(): Teams
    {
        return new Teams($this->client);
    }

    public function calls(): Calls
    {
        return new Calls($this->client);
    }
}
