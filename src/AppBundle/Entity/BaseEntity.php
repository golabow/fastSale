<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass 
 */
class BaseEntity {
  
  /**
   * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
   */
  private $created;
  
  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $modif;
  
  /**
   * ORM\Column(type="boolean") 
   */
  private $is_active = true;
  
  public   function __construct() {
    $this->setModif(new \DateTime());
    if ($this->getCreated() instanceof \DateTime === FALSE) {
      $this->setCreated(new \DateTime());
    }
  }
  
  function getCreated() {
    return $this->created;
  }

  function getModif() {
    return $this->modif;
  }

  function getIs_active() {
    return $this->is_active;
  }

  function setCreated($created) {
    $this->created = $created;
  }

  function setModif($modif) {
    $this->modif = $modif;
  }

  function setIs_active($is_active) {
    $this->is_active = $is_active;
  }


  
}
