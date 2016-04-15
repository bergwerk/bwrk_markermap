<?php

namespace BERGWERK\BwrkMarkermap\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Marker extends AbstractEntity
{
    /**
     * @var int
     */
    protected $hidden;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $zip;
    /**
     * @var string
     */
    protected $countryCode;
    /**
     * @var string
     */
    protected $city;
    /**
     * @var string
     */
    protected $infoWindow;
    /**
     * @var string
     */
    protected $lat;
    /**
     * @var string
     */
    protected $lng;

    /**
     * @return int
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param int $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * @param string $infoWindow
     */
    public function setInfoWindow($infoWindow)
    {
        $this->infoWindow = $infoWindow;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param string $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }
}