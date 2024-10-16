<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Company API
 *
 * @see https://developer.aircall.io/api-references/#company
 */
class Company extends BaseApi
{

    /**
     * Retrieve Company
     *
     * @return AircallApiResponse
     */
    public function get(): AircallApiResponse
    {
        $response = $this->client
            ->get('company');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'company');
    }

}
