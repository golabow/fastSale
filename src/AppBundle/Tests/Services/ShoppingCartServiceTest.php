<?php

use AppBundle\Services\ShoppingCartService;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Product;
use AppBundle\Entity\Currency;

class ShoppingCartServiceTest extends TestCase {
  
  private $sessionMock;
  private $shoppingCartService;
  
  private function getProduct(int $id = 1, string $name = 'test', string $desc = 'test', float $price = 3, Currency $currency = null) : Product {
    if (is_null($currency) === TRUE) {
      $currency = new Currency('PLN');
    }
    $p = new Product();
    $p->setId($id);
    $p->setName($name);
    $p->setDescription($desc);
    $p->setPrice($price);
    $p->setCurrency($currency);
    return $p;
  }
  
  public function setUp() : void {
    $this->sessionMock = $this->createMock(\Symfony\Component\HttpFoundation\Session\SessionInterface::class);
    $this->shoppingCartService = new ShoppingCartService($this->sessionMock);
  }
  
  public function testAddItemToCart() : void {
    $product = $this->getProduct();
    $this->shoppingCartService->addProductToCart($product);
    
    $this->assertEquals($this->shoppingCartService->getCartProductsCount(), 1);
    $this->assertEquals($this->shoppingCartService->getProductsInCart()[0], $product);    
  }
  
  public function testIsProductAlreadyInCart() : void {
    $product1 = $this->getProduct(1);
    $product2 = $this->getProduct(2);
    
    $this->shoppingCartService->addProductToCart($product1);
    
    $this->assertTrue($this->shoppingCartService->isProductAlreadyInCart($product1));
    $this->assertFalse($this->shoppingCartService->isProductAlreadyInCart($product2));
  }
  
  public function testGetCostOfProductsInCart() : void {
    $product1 = $this->getProduct(1, 'test', 'test', 30);
    $product2 = $this->getProduct(2, 'test', 'test', 50);
    
    $this->shoppingCartService->addProductToCart($product1);
    $this->shoppingCartService->addProductToCart($product2);
    
    $this->assertEquals($this->shoppingCartService->getCostOfProductsInCart(), 80);
  }
  
  /**
   * @dataProvider providerTestgetProductsInCartIds
   */
  function testGetProductsInCartIds(Array $products, Array $result) : void {
    foreach($products as $product) {
      $this->shoppingCartService->addProductToCart($product);
    }
    $this->assertEquals($this->shoppingCartService->getProductsInCartIds(), $result);
  }
  
  /**
   * @return array
   */
  public function providerTestgetProductsInCartIds() : array {
    return array(
        array(
            array($this->getProduct(2), $this->getProduct(3)),
            array(2,3)
        )
    );
  }

}
