<?php

namespace Kata\Solution;

use Kata\External\Bank;
use Kata\External\Inventory;

final readonly class Marketplace
{
    public function __construct(private Bank $bank, private Inventory $inventory)
    {
    }

    public function purchase(Purchase $purchase)
    {
    }
}
