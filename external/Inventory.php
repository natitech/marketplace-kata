<?php

namespace Kata\External;

interface Inventory
{
    /** @throws ProductNotAvailableException */
    public function removeProduct(Product $product);
}
