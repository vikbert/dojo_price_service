<?php

declare(strict_types = 1);

use Domain\Entity\Collection\ProductCollection;
use Domain\Entity\Product;
use Domain\Value\Price;
use Domain\Value\TaxRateDE;
use PHPUnit\Framework\TestCase;

class ProductCollectionTest extends Testcase
{
    private $normalTaxRate;
    private $reducedTaxRate;

    protected function setUp()
    {
        $this->normalTaxRate = TaxRateDE::getNormalTaxRate();
        $this->reducedTaxRate = TaxRateDE::getReducedTaxRate();
    }

    public function testEmptyCollection()
    {
        $products = new ProductCollection();

        $this->assertEmpty($products->getIterator());
    }

    public function testCollectionWithProducts()
    {
        $products = new ProductCollection(
            new Product('P1', new Price(1001), $this->normalTaxRate),
            new Product('P2', new Price(1002), $this->reducedTaxRate)
        );

        $this->assertCount(2, $products);
    }

    public function testAddProduct()
    {
        $p1 = new Product('P1', new Price(1099), $this->normalTaxRate);

        $products = new ProductCollection();

        $this->assertCount(1, $products->addProduct($p1));
        $this->assertCount(2, $products->addProduct($p1));
    }
}
