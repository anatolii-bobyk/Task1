<?php

declare(strict_types=1);

namespace Models;

require_once 'TerminalInterface.php';

class Terminal implements TerminalInterface
{
    /** @var string */
    public $total;

    /** @var Order */
    private $order;
    /** @var CalculatePrice */
    private $price;

    /**
     * @param CalculatePrice $price
     * @return void
     */
    public function setPrice(CalculatePrice $price): void
    {
        $this->price = $price;
    }

    /**
     * @param $code
     * @return void
     */
    public function scan($code): void
    {
        if (!isset($this->order)) {
            $this->reset();
        }
        $this->order->addItem($code);
        $this->total = $this->order->getTotal();
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->order = new Order($this->price);
        $this->total = '';
    }
}
