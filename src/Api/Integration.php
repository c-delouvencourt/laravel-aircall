<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Integration API
 *
 * @see https://developer.aircall.io/api-references/#integration
 */
class Integration extends BaseApi
{

    /**
     * Retrieve Integration information
     *
     * @return AircallApiResponse
     */
    public function get(): AircallApiResponse
    {
        $response = $this->client
            ->get('integration');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'integration');
    }

    /**
     * Enable Integration
     *
     * @return AircallApiResponse
     */
    public function enable(): AircallApiResponse
    {
        $response = $this->client
            ->post('integration/enable');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Disable Integration
     *
     * @return AircallApiResponse
     */
    public function disable(): AircallApiResponse
    {
        $response = $this->client
            ->post('integration/disable');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }
}
