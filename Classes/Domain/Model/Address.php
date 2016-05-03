<?php
namespace BERGWERK\BwrkMarkermap\Domain\Model;

class Address extends \BERGWERK\BwrkAddress\Domain\Model\Address
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BERGWERK\BwrkMarkermap\Domain\Model\MarkerStyle>
     */
    protected $style;

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BERGWERK\BwrkMarkermap\Domain\Model\MarkerStyle>
     */
    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style)
    {
        return $this->style = $style;
    }
}