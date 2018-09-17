<?php

namespace AppBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;
use AppBundle\Entity\Currency;
use AppBundle\Entity\ProductType;

class FastSaleFixture extends Fixture {
  
  public function load(ObjectManager $manager) {
    
    $currency = new Currency('PLN');
    $manager->persist($currency);
    
    $productType1 = new ProductType('book', 'sc.jpg');
    $productType2 = new ProductType('game', 'fallout.jpg');
    $productType3 = new ProductType('food', 'pizza.jpg');
    
    for($i = 0; $i < 12; $i++) {
      $rand = random_int(1, 3);
      
      $t = 'book';
      $pt = $productType1;
      switch($rand) {
        case 2:
          $t = 'game';
          $pt = $productType2;
          break;
        case 3:
          $t = 'food';
          $pt = $productType3;
          break;
      }
              
      $p = new Product();
      $p->setName(sprintf('great %s nr. %d', $t, $i + 1));
      $p->setPrice(($i + 100) * 3);
      $p->setDescription($this->getFakeDescription());
      $p->setCurrency($currency);
      $p->setType($pt);
      
      $manager->persist($p);
    }
    
    $manager->flush();
  }
  
  private function getFakeDescription() {
    $words = array('great', 'oh', 'amazing', '9/10');
    $desc = '';
    for($i = 0; $i < 20; $i++) {
      $desc .= $words[rand(0, count($words) - 1)] . ' ';
    }
    return trim($desc);
  }
  
}
