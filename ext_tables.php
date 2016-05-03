<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('BERGWERK.' . 'bwrk_markermap', 'Pi1', 'BERGWERK Marker Map');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'BERGWERK Marker Map');

$pluginSignature = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY)) . '_' . strtolower('Pi1');
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, \BERGWERK\BwrkMarkermap\Utility\FlexForm\Pi1::renderStatic());