<?php

interface Inventory
{
    /** @throws ProductNotAvailableException */
    public function removeProduct(Product $product);
}
