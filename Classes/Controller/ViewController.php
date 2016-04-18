<?php

namespace BERGWERK\BwrkMarkermap\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ViewController extends ActionController
{
    /**
     * @var \BERGWERK\BwrkMarkermap\Domain\Repository\MarkerRepository
     * @inject
     */
    protected $markerRepository;

    public function indexAction()
    {
        $cObj = $this->configurationManager->getContentObject()->data;
        $this->view->assignMultiple(array(
            'markers' => $this->buildMarkerJs($this->markerRepository->findAll(), $cObj),
            'cObj' => $cObj
        ));
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
                }
            };';
            $i++;
        }
        return $js;
    }
}