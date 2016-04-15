<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('BERGWERK.' . 'bwrk_markermap', 'Pi1', 'BERGWERK Marker Map');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'BERGWERK Marker Map');