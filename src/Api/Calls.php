<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Models\AircallApiResponse;

/**
 * Teams API
 *
 * @see https://developer.aircall.io/api-references/#team
 */
class Calls extends BaseApi
{
    /**
     * List all Calls
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function list(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('calls', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'calls');
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
            ->get('calls/' . $id);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'call');
    }

    /**
     * Search Calls
     *
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function search(array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/search', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'calls');
    }

    /**
     * Transfer Call
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function transfer(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('calls/' . $id . '/transfers', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Comment a Call
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function comment(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('calls/' . $id . '/comments', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), "content");
    }

    /**
     * Tag a Call
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function tag(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->post('calls/' . $id . '/tags', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), "tags");
    }

    /**
     * Archive a Call
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function archive(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('calls/' . $id . '/archive', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'call');
    }

    /**
     * Unarchive a Call
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function unarchive(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->put('calls/' . $id . '/unarchive', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'call');
    }

    /**
     * Pause Recording a Call
     *
     * @param int $id Call ID
     *
     * @return AircallApiResponse
     */
    public function pauseRecording(int $id): AircallApiResponse
    {
        $response = $this->client
            ->post('calls/' . $id . '/pause_recording');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Resume Recording a Call
     *
     * @param int $id Call ID
     *
     * @return AircallApiResponse
     */
    public function resumeRecording(int $id): AircallApiResponse
    {
        $response = $this->client
            ->post('calls/' . $id . '/resume_recording');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Delete Call Recording
     *
     * @param int $id Call ID
     *
     * @return AircallApiResponse
     */
    public function deleteRecording(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('calls/' . $id . '/recording');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Delete Call Voicemail
     *
     * @param int $id Call ID
     *
     * @return AircallApiResponse
     */
    public function deleteVoicemail(int $id): AircallApiResponse
    {
        $response = $this->client
            ->delete('calls/' . $id . '/voicemail');

        return new AircallApiResponse($response->getStatusCode(), $response->json());
    }

    /**
     * Insight Cards
     *
     * @param int $id Call ID
     * @param array $parameters List of parameters
     *
     * @return AircallApiResponse
     */
    public function insightCards(int $id, array $parameters = []): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/' . $id . '/insight_cards', $parameters);

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'contents');
    }
}
