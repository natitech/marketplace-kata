<?php

namespace Kata\Solution\Test;

use Kata\External\Bank;
use Kata\External\Transfer;
use Kata\External\User;

final class InMemoryBank implements Bank
{
    private array $transferredFrom = [];

    private array $transferredTo = [];

    public function fromUserToPivot(User $fromUser, Transfer $transfer)
    {
        $this->transferredFrom[$fromUser->name] = $transfer->amount;
    }

    public function fromPivotToUser(User $toUser, Transfer $transfer)
    {
        $this->transferredTo[$toUser->name] = $transfer->amount;
    }

    public function getTransferredFrom(User $fromUser): int
    {
        if (!($transferred = $this->transferredFrom[$fromUser->name] ?? null)) {
            throw new \InvalidArgumentException('No transfer from ' . $fromUser->name);
        }

        return $transferred;
    }

    public function getTransferredTo(User $toUser): int
    {
        if (!($transferred = $this->transferredTo[$toUser->name] ?? null)) {
            throw new \InvalidArgumentException('No transfer to ' . $toUser->name);
        }

        return $transferred;
    }
}
