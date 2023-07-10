<?php

namespace Kata\Solution\Test;

use Kata\External\Product;
use Kata\External\ProductNotAvailableException;
use Kata\External\User;
use Kata\Solution\SafeBank;
use Kata\Solution\Marketplace;
use Kata\Solution\Purchase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MarketplaceTest extends TestCase
{
    private readonly InMemoryBank $bank;

    private readonly InMemoryInventory $inventory;

    private readonly Marketplace $marketplace;

    private readonly User $buyer;

    private readonly User $seller;

    private readonly Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bank        = new InMemoryBank();
        $this->inventory   = new InMemoryInventory();
        $this->marketplace = (new Marketplace(new SafeBank($this->bank), $this->inventory));

        $this->buyer   = new User('Alice');
        $this->seller  = new User('Bob');
        $this->product = new Product('Apple', 100);
    }

    #[Test]
    public function buyerIsPaying()
    {
        $this->purchase();

        $this->assertEquals(100, $this->bank->getTransferredFrom($this->buyer));
    }

    #[Test]
    public function availableProductIsRemovedFromInventory()
    {
        $this->purchase();

        $removedProducts = $this->inventory->getRemovedProducts();
        $this->assertCount(1, $removedProducts);
        $this->assertEquals($this->product->name, $removedProducts[0]->name);
    }

    #[Test]
    public function whenAvailableProductThenSellerIsPaid()
    {
        $this->purchase();

        $this->assertEquals(100, $this->bank->getTransferredTo($this->seller));
    }

    #[Test]
    public function missingProductThrowException()
    {
        $this->expectException(ProductNotAvailableException::class);

        $this->inventory->setIsAvailable(false);

        $this->purchase();
    }

    #[Test]
    public function missingProductRefundBuyer()
    {
        $this->inventory->setIsAvailable(false);

        try {
            $this->purchase();
        } catch (\Exception) {
        }

        $this->assertEquals(100, $this->bank->getTransferredTo($this->buyer));
    }

    private function purchase()
    {
        $this->marketplace->purchase(new Purchase($this->buyer, $this->product, $this->seller));
    }
}
