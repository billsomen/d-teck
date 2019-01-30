<?php
/**
 * Created by PhpStorm.
 * User: SOMEN
 * Date: 1/30/2019
 * Time: 9:53 AM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

//Todo : Add some validations

class User
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  // Id of the user
  protected $id;

 /**
   * @var string
   *
   * @ORM\Column(name="name", type="string")
   */
// The name of the user : the only user-input
  protected $name;

 /**
   * @var Date
   *
   * @ORM\Column(name="created_at", type="datetime")
   */
// At what time was this user created
  protected $created_at;

  /**
   * User constructor.
   * @param string $name
   */
  public function __construct($name = null)
  {
    $this->name = $name;
    $this->created_at = new \DateTime();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return Date
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * @param Date $created_at
   */
  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }
}