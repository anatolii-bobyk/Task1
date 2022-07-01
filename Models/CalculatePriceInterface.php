<?php

namespace Models;

interface CalculatePriceInterface
{
    /**
     * @param string $code
     * @param int $quantity
     * @return float
     */
    public function getProductSubtotal(string $code, int $quantity): float;

}