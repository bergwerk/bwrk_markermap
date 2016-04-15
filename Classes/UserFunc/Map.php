<?php
namespace BERGWERK\BwrkMarkermap\UserFunc;
use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Map {

    /**
     * @var float
     */
    protected $lat = 0.0;
    /**
     * @var float
     */
    protected $lng = 0.0;
    /**
     * @var string
     */
    protected $address = '';
    /**
     * @var string
     */
    protected $city = '';
    /**
     * @var string
     */
    protected $zip = '';
    /**
     * @var string
     */
    protected $countryCode = '';

    protected $baseElementId = 0;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $settings = array();

    /**
     * @param array $PA
     * @param UserElement $userElement
     * @return string
     */
    public function render(array &$PA, UserElement $userElement)
    {
        $this->configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->settings = $this->getSettings();

        $out = array();
        $this->lat = (float) $PA['row'][$PA['parameters']['lat']];
        $this->lng = (float) $PA['row'][$PA['parameters']['lng']];
        $this->address = $PA['row'][$PA['parameters']['address']];
        $this->zip = $PA['row'][$PA['parameters']['zip']];
        $this->city = $PA['row'][$PA['parameters']['city']];
        $this->countryCode = $PA['row'][$PA['parameters']['country_code']];

        $elementUid = $PA['row']['uid'];

        $this->baseElementId = isset($PA['itemFormElID']) ? $PA['itemFormElID'] : $PA['table'];
        $addressName = 'data['.$PA['table'].']['.$elementUid.'][address]';
        $mapId = $PA['table'].'_'.$elementUid.'_'. '_map';

        if (!($this->lat && $this->lng)) {
            $this->lat = $this->settings['backend.']['latitude'];
            $this->lng = $this->settings['backend.']['longitude'];
        }

        $out[] = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=de"></script>';
        $out[] = '<script type="text/javascript" src="../typo3conf/ext/bwrk_markermap/Resources/Public/Js/backend.map.js"></script>';
        $out[] = '<script type="text/javascript">';
        $out[] = '
        var thisMap = MarkerMap;
            thisMap.entityUid = '.$elementUid.';
            thisMap.modelName = "tx_bwrkmarkermap_domain_model_marker";
            thisMap.defaultLat = parseFloat('.$this->lat.');
            thisMap.defaultLng = parseFloat('.$this->lng.');

            window.onload = function() {
                thisMap.init("'.$mapId.'", "'.$addressName.'");
            };
        ';
        $out[] = '</script>';
        $out[] = '<div id="' . $this->baseElementId . '">';

        $out[] = '
			<input type="button" value="Position der Adresse auf Karte anzeigen" class="btn btn-primary" onclick="thisMap.codeAddress()">
			<p style="margin:1em 0">Sie können auch den Marker bewegen um die Position zu ändern.</p>
		';
        $out[] = '<div id="' . $mapId . '" style="height:400px;width:100%"></div>';
        $out[] = '</div>';

        return implode('', $out);
    }

    private function getSettings()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        return $settings['plugin.']['tx_bwrkmarkermap.']['settings.'];

    }
}