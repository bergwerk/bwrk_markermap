<?php

namespace BERGWERK\BwrkMarkermap\Controller;

use BERGWERK\BwrkMarkermap\Helpers\BwrkAddress;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extensionmanager\Controller\ActionController;

class MarkerWindowController extends ActionController
{
    public function getAction()
    {
        $markerUid = (int) $this->request->getArgument('uid');

        if(!empty($markerUid))
        {
            if(ExtensionManagementUtility::isLoaded('bwrk_address'))
            {
                $bwrkAddressHelper = new BwrkAddress();
                $marker = $bwrkAddressHelper->getMarker($markerUid);
            } else {
                $marker = $this->markerRepository->findByUid($markerUid);
            }

            $this->view->assign('marker', $marker);
        }
    }
}