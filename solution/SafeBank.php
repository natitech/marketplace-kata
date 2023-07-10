<?php

namespace Kata\Solution;

use Kata\External\Bank;
use Kata\External\Transfer;

final class SafeBank
{
    public function __construct(private readonly Bank $bank)
    {
    }

    public function transaction(BankTransaction $transaction)
    {
        $this->begin($transaction);

        try {
            ($transaction->operation)();
        } catch (\Exception $e) {
            $this->rollback($transaction);

            throw $e;
        }

        $this->commit($transaction);
    }

    private function begin(BankTransaction $transaction): void
    {
        $this->bank->fromUserToPivot($transaction->buyer, new Transfer($transaction->amount));
    }

    private function rollback(BankTransaction $transaction): void
    {
        $this->bank->fromPivotToUser($transaction->buyer, new Transfer($transaction->amount));
    }

    private function commit(BankTransaction $transaction): void
    {
        $this->bank->fromPivotToUser($transaction->seller, new Transfer($transaction->amount));
    }
}
