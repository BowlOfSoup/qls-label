<?php

declare(strict_types=1);

namespace App\Model\Response;

class Pagination
{
    /** @var null|int */
    private $page;

    /** @var null|int */
    private $count;

    /** @var null|int */
    private $pageCount;

    /** @var null|bool */
    private $nextPage;

    /** @var null|bool */
    private $prevPage;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): Pagination
    {
        $this->page = $page;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): Pagination
    {
        $this->count = $count;

        return $this;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function setPageCount(int $pageCount): Pagination
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function isNextPage(): ?bool
    {
        return $this->nextPage;
    }

    public function setNextPage(bool $nextPage): Pagination
    {
        $this->nextPage = $nextPage;

        return $this;
    }

    public function isPrevPage(): ?bool
    {
        return $this->prevPage;
    }

    public function setPrevPage(bool $prevPage): Pagination
    {
        $this->prevPage = $prevPage;

        return $this;
    }
}