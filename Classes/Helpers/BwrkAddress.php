<?php

namespace BERGWERK\BwrkMarkermap\Helpers;

use BERGWERK\BwrkMarkermap\Domain\Model\Address;
use BERGWERK\BwrkMarkermap\Domain\Model\Marker;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class BwrkAddress
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \BERGWERK\BwrkMarkermap\Domain\Repository\AddressRepository
     */
    protected $addressRepository;

    function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $this->addressRepository = $this->objectManager->get('BERGWERK\\BwrkMarkermap\\Domain\\Repository\\AddressRepository');
    }

    public function getMarkers()
    {
        $markers = array();
        /** @var Address[] $addresses */
        $addresses = $this->addressRepository->findAll();
        foreach ($addresses as $address) {
            $markers[] = $this->getMarker($address);
        }
        return $markers;
    }

    public function getMarker($address)
    {
        if (is_int($address)) {
            $address = $this->addressRepository->findByUid($address);
        }

        if (!is_null($address)) {
            $marker = new Marker();
            $marker->setTitle($address->getTitle());
            $marker->setAddress($address->getEntriesWithType('street_address')->getFirst()->getEntryValue());
            $marker->setZip($address->getEntriesWithType('zip')->getFirst()->getEntryValue());
            $marker->setCity($address->getEntriesWithType('city')->getFirst()->getEntryValue());
            $marker->setLat($address->getEntriesWithType('latitude')->getFirst()->getEntryValue());
            $marker->setLng($address->getEntriesWithType('longitude')->getFirst()->getEntryValue());
            $marker->setStyle($address->getStyle());
            $marker->setUid($address->getUid());

            return $marker;
        }

    }
}