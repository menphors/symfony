<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="geolocation", type="string", length=255, nullable=true)
     */
    private $geolocation;

    /**
     * @var string
     *
     * @ORM\Column(name="ISO_code", type="string", length=255)
     */
    private $iSOCode;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set geolocation
     *
     * @param string $geolocation
     *
     * @return Country
     */
    public function setGeolocation($geolocation)
    {
        $this->geolocation = $geolocation;

        return $this;
    }

    /**
     * Get geolocation
     *
     * @return string
     */
    public function getGeolocation()
    {
        return $this->geolocation;
    }

    /**
     * Set iSOCode
     *
     * @param string $iSOCode
     *
     * @return Country
     */
    public function setISOCode($iSOCode)
    {
        $this->iSOCode = $iSOCode;

        return $this;
    }

    /**
     * Get iSOCode
     *
     * @return string
     */
    public function getISOCode()
    {
        return $this->iSOCode;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return ['id' => $this->getId(),'name' => $this->getName(),'iso' => $this->getISOCode()];
    }
}

