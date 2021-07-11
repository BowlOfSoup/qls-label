<?php

declare(strict_types=1);

namespace App\Model\Response;

abstract class AbstractResponse
{
    /** @var null|Meta */
    protected $meta;

    /** @var null|Pagination */
    protected $pagination;

    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    public function setMeta(Meta $meta): AbstractResponse
    {
        $this->meta = $meta;

        return $this;
    }

    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): AbstractResponse
    {
        $this->pagination = $pagination;

        return $this;
    }
}