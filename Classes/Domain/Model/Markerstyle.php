<?php

namespace BERGWERK\BwrkMarkermap\Domain\Model\Marker;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Style extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';
    /**
     * @var string
     */
    protected $fillColor = '';
    /**
     * @var string
     */
    protected $fillOpacity = '';
    /**
     * @var string
     */
    protected $scale = '';
    /**
     * @var string
     */
    protected $anchor = '';
    /**
     * @var string
     */
    protected $svgPath = '';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }

    /**
     * @return string
     */
    public function getFillOpacity()
    {
        return $this->fillOpacity;
    }

    /**
     * @return string
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @return string
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * @return string
     */
    public function getSvgPath()
    {
        return $this->svgPath;
    }



}