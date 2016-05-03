<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'BERGWERK.' . $_EXTKEY,
    'Pi1',
    array(
        'View' => 'index'
    ),
    array(
        'View' => 'index'
    )
);

TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'BERGWERK.' . $_EXTKEY,
    'Pi2',
    array(
        'MarkerWindow' => 'get'
    ),
    array(
        'MarkerWindow' => 'get'
    )
);



$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['bwrkMarkerWindow'] = 'EXT:'.$_EXTKEY.'/Classes/Utility/Eid/MarkerWindow.php';