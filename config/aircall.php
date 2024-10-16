<?php

/*
 * Aircall API Configuration
 * https://developer.aircall.io/
 */
return [
    // API
    // https://developer.aircall.io/api-references/#authentication
    // ----------------------------------------------------------

    // The API endpoint
    'endpoint' => env('AIRCALL_ENDPOINT', 'https://api.aircall.io/v1'),

    // The API ID and Token
    'api_id' => env('AIRCALL_API_ID', ''),
    'api_token' => env('AIRCALL_API_TOKEN', ''),

    // Webhook API
    // https://developer.aircall.io/api-references/#webhook-usage
    // ----------------------------------------------------------

    /*
     * You can define the job that should be run when a certain webhook hits your application
     * here.
     *
     * You can find a list of Aircall webhook types here:
     * https://developer.aircall.io/api-references/#payload
     *
     * You can use "*" to let a job handle all sent webhook types
     */
    'webhook_jobs' => [
        // 'user.created' => \App\Jobs\Aircall\HandleAircallUserCreatedJob::class,
        // '*' => \App\Jobs\Aircall\HandleAllWebhooks::class
    ],

    /*
     * This model will be used to store all incoming webhooks.
     * It should be or extend `Spatie\GitHubWebhooks\Models\GitHubWebhookCall`
     */
    'webhook_model' => \CLDT\Aircall\Models\AircallWebhookCall::class,

    // The path where the webhook will be accessible
    'webhook_path' => env('AIRCALL_WEBHOOK_PATH', '/webhook/aircall'),

    // The path where the webhook will be accessible
    'webhook_table_name' => env('AIRCALL_WEBHOOK_TABLE_NAME', 'aircall_webhook_calls'),

    // If you want to verify the webhook token sent by Aircall
    'webhook_verify_token' => env('AIRCALL_WEBHOOK_VERIFY_TOKEN', true),

    // The token to verify the webhook
    'webhook_token' => env('AIRCALL_WEBHOOK_TOKEN', ''),

    // Prune the webhook calls after X days to keep the database clean
    'webhook_prune_calls_after_days' => env('AIRCALL_WEBHOOK_PRUNE_CALLS_AFTER_DAYS', 30),
];