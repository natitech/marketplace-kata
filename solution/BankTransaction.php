<?php

namespace Kata\Solution;

use Kata\External\User;

final readonly class BankTransaction
{
    public User $buyer;

    public User $seller;

    public int $amount;

    public \Closure $operation;

    public static function fromPurchase(Purchase $purchase, \Closure $operation): self
    {
        $transaction            = new self();
        $transaction->buyer     = $purchase->buyer;
        $transaction->seller    = $purchase->seller;
        $transaction->amount    = $purchase->product->price;
        $transaction->operation = $operation;

        return $transaction;
    }
}
