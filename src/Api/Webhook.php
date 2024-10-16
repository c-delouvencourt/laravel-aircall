<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Webhook API
 *
 * @see https://developer.aircall.io/api-references/#webhook
 */
class Webhook extends BaseApi
{

    /**
     * List All Webhooks
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('webhooks', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'webhooks');
    }

    /**
     * Get a Webhook
     *
     * @param int $id Webhook ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('webhooks/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'webhook');
    }

    /**
     * Create Webhook
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function create(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('webhooks', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'webhook');
    }

    /**
     * Update Webhook
     *
     * @param int $id Webhook ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function update(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('webhooks/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'webhook');
    }

    /**
     * Delete Webhook
     *
     * @param int $id Webhook ID
     *
     * @return AircallApiResponse
     */
    public function delete(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('webhooks/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

}
