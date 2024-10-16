<?php

namespace CLDT\Aircall\Http\Controllers;

use CLDT\Aircall\AircallWebhookSignatureValidator;
use Illuminate\Http\Request;

use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\Exceptions\InvalidWebhookSignature;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\WebhookProcessor;
use Symfony\Component\HttpFoundation\Response;

class AircallWebhooksController
{
    /**
     * @throws InvalidConfig
     */
    public function __invoke(Request $request)
    {
        $webhookConfig = new WebhookConfig([
            'name' => 'Aircall',
            'signing_secret' => config('aircall.webhook_token'),
            'signature_header_name' => '',
            'signature_validator' => AircallWebhookSignatureValidator::class,
            'webhook_profile' => '',
            'webhook_model' => config('aircall.webhook_model'),
            'process_webhook_job' => config('aircall.webhook_jobs'),
            'store_headers' => [],
        ]);

        try {
            (new WebhookProcessor($request, $webhookConfig))->process();
        } catch (InvalidWebhookSignature $ex) {
            return response()->json(['message' => 'invalid signature'], Response::HTTP_FORBIDDEN);
        }

        return response()->json(['message' => 'ok']);
    }
}