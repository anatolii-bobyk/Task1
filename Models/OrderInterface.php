<?php

namespace Models;

interface OrderInterface
{
    /**
     * @param string $item
     * @return mixed
     */
    public function addItem(string $item);

    /**
     * @return string
     */
    public function getTotal(): string;
}