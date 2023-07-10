<?php

namespace Kata\External;

final readonly class Product
{
    public function __construct(public string $name, public int $price)
    {
    }
}
