<?php
defined('TYPO3_MODE') or die();

$temporaryColumn = array(
    'style' => array (
        'exclude' => 0,
        'label' => 'LLL:EXT:bwrk_markermap/Resources/Private/Language/locallang_db.xlf:tx_bwrkmarkermap_domain_model_marker_style',
        'config' => array (
            'type' => 'select',
            'foreign_table' => 'tx_bwrkmarkermap_domain_model_marker_style',
            'size' => 1,
            'maxitems' => 1
        )
    )
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_bwrkaddress_domain_model_address',
    $temporaryColumn
);
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
//    'tx_bwrkaddress_domain_model_address',
//    'visibility',
//    'style',
//    'after:title'
//);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_bwrkaddress_domain_model_address',
    'style',
    '',
    'after:title'
);