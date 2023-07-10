<?php

namespace Kata\External;

interface Bank
{
    public function fromUserToPivot(User $fromUser, Transfer $transfer);

    public function fromPivotToUser(User $toUser, Transfer $transfer);
}
