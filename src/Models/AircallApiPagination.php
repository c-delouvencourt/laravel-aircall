<?php

namespace CLDT\Aircall\Models;

class AircallApiPagination
{
    protected int $count;
    protected int $total;
    protected int $currentPage;
    protected int $perPage;
    protected string $nextPageLink;
    protected string $previousPageLink;

    public function __construct(array $meta)
    {
        $this->count = $meta['count'];
        $this->total = $meta['total'];
        $this->currentPage = $meta['current_page'];
        $this->perPage = $meta['per_page'];
        $this->nextPageLink = $meta['next_page_link'];
        $this->previousPageLink = $meta['previous_page_link'];
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getNextPageLink()
    {
        return $this->nextPageLink;
    }

    public function getPreviousPageLink()
    {
        return $this->previousPageLink;
    }
}