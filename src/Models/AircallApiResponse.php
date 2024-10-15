<?php

namespace CLDT\Aircall\Models;

class AircallApiResponse
{

    protected int $statusCode = 200;
    protected bool $hasError = false;
    protected string $message;
    protected string $verbose;

    protected AircallApiPagination $meta;

    protected array $data;

    public function __construct(int $statusCode, array $response = [], string $dataKey = 'data')
    {
        if ($statusCode < 200 || $statusCode >= 300) {
            $this->hasError = true;
            $this->message = $response['error'];
            $this->verbose = $response['verbose'];
            $this->statusCode = $statusCode;
            $this->data = [];
            return;
        }
        if (isset($response['meta'])) {
            $this->meta = new AircallApiPagination($response['meta']);
        }
        if(!isset($response[$dataKey])) {
            $this->data = [];
            return;
        }
        $this->data = $response[$dataKey];
    }

    public function hasError(): bool
    {
        return $this->hasError;
    }

    public function getVerbose(): string
    {
        return $this->verbose;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMeta(): AircallApiPagination
    {
        return $this->meta;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getFirst(): ?array
    {
        return $this->data[0] ?? null;
    }

    public function getLast(): ?array
    {
        return $this->data[count($this->data) - 1] ?? null;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function isPaginated(): bool
    {
        return isset($this->meta);
    }

    public function getPagination(): AircallApiPagination
    {
        return $this->meta;
    }

}