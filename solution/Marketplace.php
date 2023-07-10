<?php

namespace Kata\Solution;

use Kata\External\Inventory;

final readonly class Marketplace
{
    public function __construct(private SafeBank $bank, private Inventory $inventory)
    {
    }

    public function purchase(Purchase $purchase)
    {
        $this->bank->transaction(
            BankTransaction::fromPurchase($purchase, fn() => $this->inventory->removeProduct($purchase->product))
        );
    }
}
