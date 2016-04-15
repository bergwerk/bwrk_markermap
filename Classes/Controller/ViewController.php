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
        DebuggerUtility::var_dump($this->markerRepository->findByUid(1));
    }
}