<?php

namespace CLDT\Aircall;

use CLDT\Aircall\Api\Call;
use CLDT\Aircall\Api\Company;
use CLDT\Aircall\Api\Contact;
use CLDT\Aircall\Api\ConversationIntelligence;
use CLDT\Aircall\Api\DialerCampaign;
use CLDT\Aircall\Api\Integration;
use CLDT\Aircall\Api\Message;
use CLDT\Aircall\Api\Number;
use CLDT\Aircall\Api\Tag;
use CLDT\Aircall\Api\Team;
use CLDT\Aircall\Api\User;
use CLDT\Aircall\Api\Webhook;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Aircall
{
    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . base64_encode(config('aircall.api_id') . ':' . config('aircall.api_token')),
            'Content-Type' => 'application/json',
        ])->baseUrl(config('aircall.endpoint'));
    }

    public static function build()
    {
        return new static();
    }

    public function user(): User
    {
        return new User($this->client);
    }

    public function team(): Team
    {
        return new Team($this->client);
    }

    public function call(): Call
    {
        return new Call($this->client);
    }

    public function dialerCampaign(): DialerCampaign
    {
        return new DialerCampaign($this->client);
    }

    public function number(): Number
    {
        return new Number($this->client);
    }

    public function conversationIntelligence(): ConversationIntelligence
    {
        return new ConversationIntelligence($this->client);
    }

    public function message(): Message
    {
        return new Message($this->client);
    }

    public function contact(): Contact
    {
        return new Contact($this->client);
    }

    public function tag(): Tag
    {
        return new Tag($this->client);
    }

    public function webhook(): Webhook
    {
        return new Webhook($this->client);
    }

    public function company(): Company
    {
        return new Company($this->client);
    }

    public function integration(): Integration
    {
        return new Integration($this->client);
    }
}
