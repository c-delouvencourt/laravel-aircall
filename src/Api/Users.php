<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Models\AircallApiResponse;

/**
 * Users API
 *
 * @see https://developer.aircall.io/api-references/#users
 */
class Users extends BaseApi
{
    /**
     * List all Users
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('users', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'users');
    }

    /**
     * Get a User
     *
     * @param int $id User ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('users/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'user');
    }

    /**
     * Create User
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function create(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('users', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'user');
    }

    /**
     * Update User
     *
     * @param int $id User ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function update(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('users/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'user');
    }

    /**
     * Delete User
     *
     * @param int $id User ID
     *
     * @return AircallApiResponse
     */
    public function delete(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('users/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'user');
    }

    /**
     * Retrieve list of Users availability
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function listAvailability(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('users/availabilities', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'users');
    }

    /**
     * Check User availability
     *
     * @param int $id User ID
     *
     * @return AircallApiResponse
     */
    public function checkAvailability(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('users/' . $id . '/availability');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'availability');
    }

    /**
     * Start an outbound call
     *
     * @param int $id User ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function startOutboundCall(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('users/' . $id . '/calls', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'to');
    }

    /**
     * Dial a phone number in the Phone
     *
     * @param int $id User ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function dialPhoneNumber(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('users/' . $id . '/phone_number', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'to');
    }
}
