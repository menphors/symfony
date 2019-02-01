<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelDetail
 *
 * @ORM\Table(name="hotel_detail")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HotelRepository")
 */
class HotelDetail
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
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="features", type="string", length=255)
     */
    private $features;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="text")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_zip", type="string", length=255)
     */
    private $postalZip;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="integer")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string", length=255)
     */
    private $geo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="text")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="check_in", type="string", length=255)
     */
    private $checkIn;

    /**
     * @var string
     *
     * @ORM\Column(name="ischeck", type="string", length=50)
     */
    private $ischeck;

    /**
     * @var string
     *
     * @ORM\Column(name="cityID", type="string", length=255)
     */
    private $cityID;


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
     * @return HotelDetail
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
     * Set rating
     *
     * @param integer $rating
     *
     * @return HotelDetail
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set features
     *
     * @param string $features
     *
     * @return HotelDetail
     */
    public function setFeatures($features)
    {
        $this->features = $features;

        return $this;
    }

    /**
     * Get features
     *
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return HotelDetail
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return HotelDetail
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return HotelDetail
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalZip
     *
     * @param string $postalZip
     *
     * @return HotelDetail
     */
    public function setPostalZip($postalZip)
    {
        $this->postalZip = $postalZip;

        return $this;
    }

    /**
     * Get postalZip
     *
     * @return string
     */
    public function getPostalZip()
    {
        return $this->postalZip;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return HotelDetail
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return HotelDetail
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set geo
     *
     * @param string $geo
     *
     * @return HotelDetail
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;

        return $this;
    }

    /**
     * Get geo
     *
     * @return string
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return HotelDetail
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return HotelDetail
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set checkIn
     *
     * @param string $checkIn
     *
     * @return HotelDetail
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    /**
     * Get checkIn
     *
     * @return string
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * Set ischeck
     *
     * @param string $ischeck
     *
     * @return HotelDetail
     */
    public function setIscheck($ischeck)
    {
        $this->ischeck = $ischeck;

        return $this;
    }

    /**
     * Get ischeck
     *
     * @return string
     */
    public function getIscheck()
    {
        return $this->ischeck;
    }

    /**
     * Set cityID
     *
     * @param string $cityID
     *
     * @return HotelDetail
     */
    public function setCityID($cityID)
    {
        $this->cityID = $cityID;

        return $this;
    }

    /**
     * Get cityID
     *
     * @return string
     */
    public function getCityID()
    {
        return $this->cityID;
    }
}

