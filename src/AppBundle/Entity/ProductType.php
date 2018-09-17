<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_type")
 */
class ProductType extends BaseEntity  {
  
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   */
  private $id;
  
  /**
   * @ORM\Column(type="string")
   */
  private $name;
  
  /**
   * @ORM\Column(type="string")
   */
  private $photoPath;
  
  public function __construct(string $name, string $photoPath) {
    parent::__construct();
    $this->setName($name);
    $this->setPhotoPath($photoPath);
  }
  
  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getPhotoPath() {
    return $this->photoPath;
  }
  
  public function getPhotoFullPath() {
    return sprintf('/img/%s', $this->getPhotoPath());
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setPhotoPath($photoPath) {
    $this->photoPath = $photoPath;
  }


  
}
