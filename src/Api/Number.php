<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Number API
 *
 * @see https://developer.aircall.io/api-references/#number
 */
class Number extends BaseApi
{
    /**
     * List all Numbers
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('numbers', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'numbers');
    }

    /**
     * Get a Number
     *
     * @param int $id Number ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('numbers/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'number');
    }

    /**
     * Update Number
     *
     * @param int $id Number ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function update(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('numbers/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'number');
    }

    /**
     * Update music and messages for a Number
     *
     * @param int $id Number ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function updateMusicAndMessages(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('numbers/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'number');
    }

    /**
     * Registration Status
     *
     * @param int $id Number ID
     *
     * @return AircallApiResponse
     */
    public function registrationStatus(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('numbers/' . $id . '/registration_status');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }
}
