<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City implements JsonSerializable
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
     * @ORM\Column(name="geolocation", type="string", length=255)
     */
    private $geolocation;

    /**
     * @var string
     *
     * @ORM\Column(name="ISO_code", type="string", length=255, nullable=true)
     */
    private $iSOCode;

    /**
     * @var string
     *
     * @ORM\Column(name="CountryID", type="string", length=255)
     */
    private $countryID;


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
     * @return City
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
     * @return City
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
     * @return City
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

    /**
     * Set countryID
     *
     * @param string $countryID
     *
     * @return City
     */
    public function setCountryID($countryID)
    {
        $this->countryID = $countryID;

        return $this;
    }

    /**
     * Get countryID
     *
     * @return string
     */
    public function getCountryID()
    {
        return $this->countryID;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return ['id' => $this->getId(),'name' =>$this->getName(),'iso' =>$this->getISOCode(),'country_id' => $this->countryID];
    }
}

