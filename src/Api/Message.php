<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Message API
 *
 * @see https://developer.aircall.io/api-references/#message
 */
class Message extends BaseApi
{

    /**
     * Create Number Configuration
     *
     * @param int $id Number ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function createNumberConfiguration(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('numbers/' . $id . '/messages/configuration', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Get Number Configuration
     *
     * @param int $id Number ID
     *
     * @return AircallApiResponse
     */
    public function getNumberConfiguration(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('numbers/' . $id . '/messages/configuration');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Delete Number Configuration
     *
     * @param int $id Number ID
     *
     * @return AircallApiResponse
     */
    public function deleteNumberConfiguration(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('numbers/' . $id . '/messages/configuration');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Send a message
     *
     * @param int $id Number ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function sendMessage(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('numbers/' . $id . '/messages/send', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

}
