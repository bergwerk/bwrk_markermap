<?php

$configuration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$configuration->setExt('bwrk_markermap');
$configuration->setModel('tx_bwrkmarkermap_domain_model_marker_style');
$configuration->setLabelField('title');
$configuration->setIconFile('EXT:bwrk_markermap/ext_icon.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($configuration);

$tca->addCheckField('hidden');

$tca->addInputField('title');
$tca->addInputField('fill_color');
$tca->addInputField('fill_opacity');
$tca->addInputField('scale');
$tca->addInputField('anchor');

$tca->addTextField('svg_path');

return $tca->createTca();