<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product extends BaseEntity {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   */
  private $id;

  /**
   * @ORM\JoinColumn(name="type", referencedColumnName="id")
   * @ORM\ManyToOne(targetEntity="ProductType", cascade={"persist"})
   * @Assert\NotNull()
   */
  private $type;
  
  /**
   * @ORM\Column(type="string")
   * @Assert\NotNull()
   */
  private $name;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotNull()
   * @Assert\Length(min=100)
   */
  private $description;

  /**
   * @ORM\Column(type="decimal", precision=100, scale=2)
   * @Assert\NotNull()
   * @Assert\GreaterThan(0)
   */
  private $price;

  /**
   * @ORM\JoinColumn(name="currency", referencedColumnName="id")
   * @ORM\ManyToOne(targetEntity="Currency", cascade={"persist"})
   * @Assert\NotNull()
   */
  private $currency;
  
  function getId() {
    return $this->id;
  }

  function getName() {
    return $this->name;
  }

  function getDescription() {
    return $this->description;
  }

  function getPrice() {
    return $this->price;
  }

  function getCurrency() {
    return $this->currency;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setName($name) {
    $this->name = $name;
  }

  function setDescription($description) {
    $this->description = $description;
  }

  function setPrice($price) {
    $this->price = $price;
  }

  function setCurrency($currency) {
    $this->currency = $currency;
  }
  
  public function getType() {
    return $this->type;
  }

  public function setType($type) {
    $this->type = $type;
  }



}
