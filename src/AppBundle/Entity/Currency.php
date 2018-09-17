<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency extends BaseEntity {
  
  /**
   * @ORM\Column(type="string")
   * @ORM\Id
   */
  private $id;
  
  /**
   * @ORM\Column(type="string")
   */
  private $name;
  
  public function __construct($id) {
    parent::__construct();
    $this->setId($id);
    $this->setName($this->getId());
  }
  
  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setName($name) {
    $this->name = $name;
  }
  
  public function __toString() {
    return $this->getName();
  }

}
