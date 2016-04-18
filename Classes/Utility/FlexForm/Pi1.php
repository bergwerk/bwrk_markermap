<?php

namespace BERGWERK\BwrkMarkermap\Utility\FlexForm;

use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

class Pi1 extends FlexForm {
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt('bwrk_markermap');
        $configuration->setPlugin('Pi1');
        $this->init($configuration);
    }

    public function render()
    {
        $this->addSheet('general', array(
            $this->addInputField('map_center_lat'),
            $this->addInputField('map_center_lng'),
            $this->addInputField('map_zoom')
        ));
        return $this->renderFlexForm();
    }
}