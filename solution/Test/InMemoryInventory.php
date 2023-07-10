<?php

namespace Kata\Solution\Test;

use Kata\External\Inventory;
use Kata\External\Product;
use Kata\External\ProductNotAvailableException;

final class InMemoryInventory implements Inventory
{
    private array $removedProducts = [];

    private bool $isAvailable = true;

    public function removeProduct(Product $product)
    {
        if (!$this->isAvailable) {
            throw new ProductNotAvailableException('Product ' . $product->name . ' not available');
        }

        $this->removedProducts[] = $product;
    }

    public function getRemovedProducts(): array
    {
        return $this->removedProducts;
    }

    public function setIsAvailable(bool $isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }
}
