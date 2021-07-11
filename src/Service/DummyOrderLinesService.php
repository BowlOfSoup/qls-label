<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\OrderLine;

class DummyOrderLinesService
{
    /**
     * @return array|OrderLine[]
     */
    static public function getDummyOrderLines(): array
    {
        return [
            (new OrderLine())->setNumber(2)->setProductName('Jeans - Black - 36'),
            (new OrderLine())->setNumber(1)->setProductName('Sjaal - Rood Oranje'),
        ];
    }
}