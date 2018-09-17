<?php

namespace AppBundle\Services;

use AppBundle\Entity\Product;

class ShoppingCartService {

  private $session;
  private $items;

  /**
   * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
   */
  public function __construct(\Symfony\Component\HttpFoundation\Session\SessionInterface $session) {
    $this->session = $session;
    $this->items = $this->session->get('items') !== null ? $this->session->get('items') : array();
    if (is_array($this->items) === FALSE) {
      $this->items = array($this->items);
    }
  }
  
  /**
   * @param Product $product
   * @throws Exception
   */
  private function addItemToCart(Product $product): void {
    if ($this->isProductAlreadyInCart($product) === TRUE) {
      throw new \Exception(sprintf('Item id: %d, already exists in cart', $product->getId()));
    }
    $this->items[] = $product;
  }
  
  /**
   * @param Product $product
   * @return int
   * @throws Exception
   */
  private function findProductIndexInCart(Product $product): int {
    $itemIndex = null;
    for ($i = 0, $j = $this->getCartProductsCount(); $i < $j; $i++) {
      if ($this->items[$i]->getId() === $product->getId()) {
        $itemIndex = $i;
        break;
      }
    }
    
    if ($itemIndex === null) {
      throw new \Exception(sprintf('Cant find product id:%d in cart', $product->getId()));
    }
    
    return $itemIndex;
  }
  
  private function setItemsToSession(): void {
    $this->session->set('items', $this->items);
  }
  
  private function reindexItems() : void {
    $this->items = array_values($this->items);
  }
  
  /**
   * @param type $index
   */
  private function unsetFromItems(int $index) : void {
    unset($this->items[$index]);
  }

  /**
   * @param Product $product
   * @throws Exception
   */
  public function addProductToCart(Product $product): void {
    $this->addItemToCart($product);
    $this->setItemsToSession();
  }
  
  /**
   * @param Product $product
   * @return bool
   */
  public function removeProductFromCart(Product $product): void {
    $itemIndex = $this->findProductIndexInCart($product);
    if ($itemIndex !== null) {
      $this->unsetFromItems($itemIndex);
      $this->reindexItems();
      $this->setItemsToSession();
      return;
    }
    throw new \Exception('Cant find passed product');
  }
  
  /**
   * @return array
   */
  public function getProductsInCart(): array {
    return $this->items;
  }

  /**
   * @return array
   */
  public function getProductsInCartIds(): array {
    $productsIdsArray = array();
    foreach ($this->items as $item) {
      $productsIdsArray[] = $item->getId();
    }
    return $productsIdsArray;
  }

  /**
   * @return string
   */
  public function getProductsInCartsIdsJson(): string {
    return json_encode($this->getProductsInCartIds());
  }
  
  /**
   * @TODO
   */
  public function saveCartToDatabase(): void {

  }
  
  /**
   * @return int
   */
  public function getCartProductsCount(): int {
    return count($this->items);
  }

  /**
   * @param Product $product
   * @return bool
   */
  public function isProductAlreadyInCart(Product $product): bool {
    foreach ($this->items as $item) {
      if ($item->getId() === $product->getId()) {
        return true;
      }
    }
    return false;
  }

  /**
   * @return float
   */
  public function getCostOfProductsInCart(): float {
    $cost = 0;
    foreach ($this->items as $item) {
      $cost += $item->getPrice();
    }
    return $cost;
  }

}
