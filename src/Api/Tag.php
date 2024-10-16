<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Tag API
 *
 * @see https://developer.aircall.io/api-references/#tag
 */
class Tag extends BaseApi
{

    /**
     * List All Tags
     *
     * @return AircallApiResponse
     */
    public function list(): AircallApiResponse
    {
        $response = $this->client
            ->get('tags');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'tags');
    }

    /**
     * Get a Tag
     *
     * @param int $id Tag ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('tags/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'tag');
    }

    /**
     * Create Tag
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function create(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('tags', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'tag');
    }

    /**
     * Update Tag
     *
     * @param int $id Tag ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function update(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('tags/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'tag');
    }

    /**
     * Delete Tag
     *
     * @param int $id Tag ID
     *
     * @return AircallApiResponse
     */
    public function delete(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('tags/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }
}
