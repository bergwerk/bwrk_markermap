<?php

namespace BERGWERK\BwrkMarkermap\Controller;

use BERGWERK\BwrkMarkermap\Domain\Model\Marker;
use BERGWERK\BwrkMarkermap\Helpers\BwrkAddress;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ViewController extends ActionController
{
    /**
     * @var \BERGWERK\BwrkMarkermap\Domain\Repository\MarkerRepository
     * @inject
     */
    protected $markerRepository;

    /**
     * @var int
     */
    protected $useBwrkAddress = 0;

    protected function initializeAction()
    {
        parent::initializeAction();

        $this->useBwrkAddress = (int) $this->settings['bwrk_address'];
    }


    public function indexAction()
    {
        $markers = null;

        if($this->useBwrkAddress && ExtensionManagementUtility::isLoaded('bwrk_address'))
        {
            $bwrkAddressHelper = new BwrkAddress();
            $markers = $bwrkAddressHelper->getMarkers();
        } else {
            $markers = $this->markerRepository->findAll();
        }
        $cObj = $this->configurationManager->getContentObject()->data;
        $this->view->assignMultiple(array(
            'markers' => $markers,
            'markersJs' => $this->buildMarkerJs($markers, $cObj),
            'cObj' => $cObj
        ));
    }

    public function loadMarkerWindowAction()
    {

    }

    /**
     * @param Marker[] $markers
     * @return string
     */
    private function buildMarkerJs($markers, $cObj)
    {
        $js = '';
        $js.= 'var bwrkMarkerMapMarkers_'.$cObj['uid'].' = [];';
        /** @var Marker $marker */
        $i=0;
        foreach($markers as $marker)
        {
            $js.= '
            bwrkMarkerMapMarkers_'.$cObj['uid'].'['.$i.'] = {
                title: "'.$marker->getTitle().'",
                position: {lat: '.$marker->getLat().', lng: '.$marker->getLng().'},
                icon: {
                    path: "'.$marker->getStyle()->getSvgPath().'",
                    fillColor: "'.$marker->getStyle()->getFillColor().'",
                    fillOpacity: '.$marker->getStyle()->getFillOpacity().',
                    scale: '.$marker->getStyle()->getScale().',
                    strokeWeight: 0,
                    anchor: new google.maps.Point('.$marker->getStyle()->getAnchor().')
                },
                uid: '.$marker->getUid().'
            };';
            $i++;
        }
        return $js;
    }
}