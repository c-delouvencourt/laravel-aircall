<?php

namespace CLDT\Aircall;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class AircallWebhookSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        if (! config('aircall.verify_signature')) {
            return true;
        }

        $token = $config->signingSecret;
        $request_token = $request->input('token');

        if(! $request_token) {
            return false;
        }

        if ($token != $request_token) {
            return false;
        }

        return true;
    }
}