<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Team API
 *
 * @see https://developer.aircall.io/api-references/#team
 */
class Team extends BaseApi
{
    /**
     * List all Teams
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('teams', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'teams');
    }

    /**
     * Get a Team
     *
     * @param int $id User ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('teams/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'user');
    }

    /**
     * Create Team
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function create(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('teams', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'team');
    }

    /**
     * Delete Team
     *
     * @param int $id User ID
     *
     * @return AircallApiResponse
     */
    public function delete(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('teams/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Add User to Team
     *
     * @param int $teamId Team ID
     * @param int $userId User ID
     *
     * @return AircallApiResponse
     */
    public function addUser(int $teamId, int $userId): AircallApiResponse
    {
        $response = $this->client
            ->post('teams/' . $teamId . '/users/' . $userId);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'team');
    }

    /**
     * Remove User from Team
     *
     * @param int $teamId Team ID
     * @param int $userId User ID
     *
     * @return AircallApiResponse
     */
    public function removeUser(int $teamId, int $userId): AircallApiResponse
    {
        $response = $this->client
            ->delete('teams/' . $teamId . '/users/' . $userId);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'team');
    }
}
