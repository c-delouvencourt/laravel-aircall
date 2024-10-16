<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Dialer Campaign API
 *
 * @see https://developer.aircall.io/api-references/#dialer-campaign
 */
class DialerCampaign extends BaseApi
{
    /**
     * Retrieve a Dialer Campaign
     *
     * @param int $user_id Dialer Campaign ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $user_id): AircallApiResponse
    {
        $response = $this->client
            ->get('users/' . $user_id . '/dialer_campaign');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'dialer_campaign');
    }

    /**
     * Create a Dialer Campaign
     *
     * @param int $user_id User ID
     * @param array $phone_numbers List of phone numbers
     *
     * @return AircallApiResponse
     */
    public function createDialerCampaign(int $user_id, array $phone_numbers): AircallApiResponse
    {
        $response = $this->client
            ->post('users/' . $user_id . '/dialer_campaign', ['phone_numbers' => $phone_numbers]);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Delete a Dialer Campaign
     *
     * @param int $user_id User ID
     *
     * @return AircallApiResponse
     */
    public function deleteDialerCampaign(int $user_id): AircallApiResponse
    {
        $response = $this->client
            ->delete('users/' . $user_id . '/dialer_campaign');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Retrieve Phone Numbers
     *
     * @param int $user_id User ID
     *
     * @return AircallApiResponse
     */
    public function getPhoneNumbers(int $user_id): AircallApiResponse
    {
        $response = $this->client
            ->get('users/' . $user_id . '/dialer_campaign/phone_numbers');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'numbers');
    }


    /**
     * Add Phone Numbers
     *
     * @param int $user_id User ID
     * @param array $phone_numbers List of phone numbers
     *
     * @return AircallApiResponse
     */
    public function addPhoneNumbers(int $user_id, array $phone_numbers): AircallApiResponse
    {
        $response = $this->client
            ->post('users/' . $user_id . '/dialer_campaign/phone_numbers', ['phone_numbers' => $phone_numbers]);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'phone_numbers');
    }


    /**
     * Delete Phone Numbers
     *
     * @param int $user_id User ID
     * @param int $number_id Number ID
     *
     * @return AircallApiResponse
     */
    public function deletePhoneNumber(int $user_id, int $number_id): AircallApiResponse
    {
        $response = $this->client
            ->delete('users/' . $user_id . '/dialer_campaign/phone_numbers/' . $number_id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }
}
