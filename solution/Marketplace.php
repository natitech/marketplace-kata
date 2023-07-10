<?php

namespace Kata\Solution;

use Kata\External\Bank;
use Kata\External\Inventory;
use Kata\External\Product;
use Kata\External\Transfer;

final readonly class Marketplace
{
    public function __construct(private Bank $bank, private Inventory $inventory)
    {
    }

    public function purchase(Purchase $purchase)
    {
        $this->prepay($purchase);

        try {
            $this->moveProduct($purchase->product);
        } catch (\Exception $e) {
            $this->refund($purchase);

            throw $e;
        }

        $this->pay($purchase);
    }

    private function prepay(Purchase $purchase): void
    {
        $this->bank->fromUserToPivot($purchase->buyer, new Transfer($purchase->product->price));
    }

    private function moveProduct(Product $product): void
    {
        $this->inventory->removeProduct($product);
    }

    private function refund(Purchase $purchase): void
    {
        $this->bank->fromPivotToUser($purchase->buyer, new Transfer($purchase->product->price));
    }

    private function pay(Purchase $purchase): void
    {
        $this->bank->fromPivotToUser($purchase->seller, new Transfer($purchase->product->price));
    }
}
