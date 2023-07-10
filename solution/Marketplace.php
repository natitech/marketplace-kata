<?php

namespace Kata\Solution;

use Kata\External\Bank;
use Kata\External\Inventory;
use Kata\External\Transfer;

final readonly class Marketplace
{
    public function __construct(private Bank $bank, private Inventory $inventory)
    {
    }

    public function purchase(Purchase $purchase)
    {
        $this->bank->fromUserToPivot($purchase->buyer, new Transfer($purchase->product->price));

        try {
            $this->inventory->removeProduct($purchase->product);
        } catch (\Exception $e) {
            $this->bank->fromPivotToUser($purchase->buyer, new Transfer($purchase->product->price));

            throw $e;
        }

        $this->bank->fromPivotToUser($purchase->seller, new Transfer($purchase->product->price));
    }
}
