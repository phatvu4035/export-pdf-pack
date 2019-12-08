<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\ImageType;
use Dotcm\ExportPDF\Domain\ValueObject\Link;
use Dotcm\ExportPDF\Domain\ValueObject\Src;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

/**
 * Class Image Render Image PDF
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
class Image
{
    /**
     * @var object
     */
    protected $src;

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
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

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
    public function __construct(ExportingPDFService $pdf, Src $src, Width $width, Height $height, ImageType $type, Link $link)
    {
        $this->pdf = $pdf;
        $this->src = $src->value();
        $this->width = $width->value();
        $this->height = $height->value();
        $this->type = $type->value();
        $this->link = $link->value();
        $this->imageToPdf();
    }

    /**
     * Render image to PDF
     */
    public function imageToPdf(): void
    {
        $this->pdf->Image($this->src, null, null, $this->width, $this->height, $this->type, $this->link);
    }
}
