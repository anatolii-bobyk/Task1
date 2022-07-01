<?php

namespace Models;

interface TerminalInterface
{
    /**
     * @param CalculatePrice $price
     * @return mixed
     */
    public function setPrice(CalculatePrice $price);

    /**
     * @param $code
     * @return mixed
     */
    public function scan($code);

    /**
     * @return mixed
     */
    public function reset();
}