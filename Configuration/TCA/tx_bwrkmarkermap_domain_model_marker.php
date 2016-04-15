<?php

$configuration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$configuration->setExt('bwrk_markermap');
$configuration->setModel('tx_bwrkmarkermap_domain_model_marker');
$configuration->setLabelField('title');
$configuration->setIconFile('EXT:bwrk_markermap/ext_icon.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($configuration);

$tca->addCheckField('hidden');

$tca->addInputField('title');
$tca->addInputField('address');
$tca->addInputField('zip');
$tca->addInputField('country_code');
$tca->addInputField('city');

$tca->addTextField('info_window', true);

$tca->addInputField('lat');
$tca->addInputField('lng');

$tca->addUserFunc('map', 'BERGWERK\BwrkMarkermap\UserFunc\Map->render', array(
    'lat' => 'lat',
    'lng' => 'lng',
    'zip' => 'zip',
    'city' => 'city',
    'address' => 'address',
    'country_code' => 'country_code'
));

return $tca->createTca();