<?php

declare(strict_types=1);

namespace Models;

require_once 'CalculatePriceInterface.php';

class CalculatePrice implements CalculatePriceInterface
{
    /** @var array */
    private $priceData;

    /**
     * CalculatePrice constructor.
     * @param array $priceData
     */
    public function __construct(array $priceData)
    {
        $this->priceData = $priceData;
    }

    /**
     * @param string $code
     * @param int $quantity
     * @return float
     */
    public function getProductSubtotal(string $code, int $quantity): float
    {
        if (!isset($this->priceData[$code][1])) {
            return 0;
        }

        $tierQuantity = max(array_keys($this->priceData[$code]));

        $groups = (int)floor($quantity / $tierQuantity);

        $singles = $quantity % $tierQuantity;

        return ($groups * (float)$this->priceData[$code][$tierQuantity]) + ($singles * (float)$this->priceData[$code][1]);
    }
}
