<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Contact API
 *
 * @see https://developer.aircall.io/api-references/#contact
 */
class Contact extends BaseApi
{

    /**
     * List Contacts
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('contacts', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contacts');
    }

    /**
     * Search Contacts
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function search(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('contacts/search', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contacts');
    }

    /**
     * Get a Contact
     *
     * @param int $id Contact ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $id): AircallApiResponse
    {
        $response = $this->client
            ->get('contacts/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contact');
    }

    /**
     * Create Contact
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function create(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('contacts', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contact');
    }

    /**
     * Update Contact
     *
     * @param int $id Contact ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function update(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('contacts/' . $id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contact');
    }

    /**
     * Delete Contact
     *
     * @param int $id Contact ID
     *
     * @return AircallApiResponse
     */
    public function delete(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('contacts/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Add phone number to a Contact
     *
     * @param int $id Contact ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function addPhoneNumber(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('contacts/' . $id . '/phone_details', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'phone_detail');
    }

    /**
     * Update phone number of a Contact
     *
     * @param int $id Contact ID
     * @param int $phone_number_id Phone Detail ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function updatePhoneNumber(int $id, int $phone_number_id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('contacts/' . $id . '/phone_details/' . $phone_number_id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'phone_detail');
    }

    /**
     * Delete phone number from a Contact
     *
     * @param int $id Contact ID
     * @param int $phone_number_id Phone Detail ID
     *
     * @return AircallApiResponse
     */
    public function deletePhoneNumber(int $id, int $phone_number_id): AircallApiResponse
    {
        $response = $this->client
            ->delete('contacts/' . $id . '/phone_details/' . $phone_number_id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Add email to a Contact
     *
     * @param int $id Contact ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function addEmail(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('contacts/' . $id . '/email_details', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'email_detail');
    }

    /**
     * Update email of a Contact
     *
     * @param int $id Contact ID
     * @param int $email_id Email Detail ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function updateEmail(int $id, int $email_id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('contacts/' . $id . '/email_details/' . $email_id, $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'email_detail');
    }

    /**
     * Delete email from a Contact
     *
     * @param int $id Contact ID
     * @param int $email_id Email Detail ID
     *
     * @return AircallApiResponse
     */
    public function deleteEmail(int $id, int $email_id): AircallApiResponse
    {
        $response = $this->client
            ->delete('contacts/' . $id . '/email_details/' . $email_id);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }
}
