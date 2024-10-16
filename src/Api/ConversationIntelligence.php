<?php

namespace CLDT\Aircall\Api;

use CLDT\Aircall\Helpers\AircallApiResponse;

/**
 * Conversation Intelligence API
 *
 * @see https://developer.aircall.io/api-references/#conversation-intelligence
 */
class ConversationIntelligence extends BaseApi
{

    /**
     * Retrieve a transcription
     *
     * @param int $call_id Call ID
     *
     * @return AircallApiResponse
     */
    public function getOne(int $call_id): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/' . $call_id . '/transcription');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'transcription');
    }

    /**
     * Retrieve sentiment analysis
     *
     * @param int $call_id Call ID
     *
     * @return AircallApiResponse
     */
    public function getSentimentAnalysis(int $call_id): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/' . $call_id . '/sentiments');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'sentiment');
    }

    /**
     * Retrieve topics
     *
     * @param int $call_id Call ID
     *
     * @return AircallApiResponse
     */
    public function getTopics(int $call_id): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/' . $call_id . '/topics');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'topic');
    }

    /**
     * Retrieve a summary
     *
     * @param int $call_id Call ID
     *
     * @return AircallApiResponse
     */
    public function getSummary(int $call_id): AircallApiResponse
    {
        $response = $this->client
            ->get('calls/' . $call_id . '/summary');

        return new AircallApiResponse($response->getStatusCode(), $response->json(), 'summary');
    }

}
