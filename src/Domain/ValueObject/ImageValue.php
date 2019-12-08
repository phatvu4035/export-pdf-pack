<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

final class ImageValue
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var float
     */
    protected $x;

    /**
     * @var float
     */
    protected $y;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $link;

    /**
     * ImageValue constructor.
     * @param $file
     * @param null   $x
     * @param null   $y
     * @param int    $width
     * @param int    $height
     * @param string $type
     * @param string $link
     */
    public function __construct($file, $x = null, $y = null, $width = 0, $height = 0, $type = '', $link = '')
    {
        $this->file = $file;
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return null|float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return null|float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
