<?php

namespace Kata\Solution;

use Kata\External\Product;
use Kata\External\User;

final readonly class Purchase
{
    public function __construct(public User $buyer, public Product $product, public User $seller)
    {
    }
}
