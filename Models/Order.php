<?php

declare(strict_types=1);

namespace Models;

require_once 'OrderInterface.php';

class Order implements OrderInterface
{
    /** @var array */
    private $items;
    /** @var CalculatePrice */
    private $price;

    /**
     * Order constructor.
     * @param CalculatePrice $price
     */
    public function __construct(CalculatePrice $price)
    {
        $this->price = $price;
    }

    /**
     * @param string $item
     */
    public function addItem(string $item): void
    {
        if (isset($this->items[$item])) {
            $this->items[$item]['quantity']++;
        } else {
            $this->items[$item]['quantity'] = 1;
        }
        $this->items[$item]['subtotal'] = $this->price->getProductSubtotal($item, $this->items[$item]['quantity']);
    }


    /**
     * @return string
     */
    public function getTotal(): string
    {
        $total = 0.00;
        foreach ($this->items as $item) {
            $total += $item['subtotal'];
        }
        return number_format($total, 2);
    }

}
