<?php


namespace Dotcm\ExportPDF\Domain\Structure;


use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\Border;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Link;
use Dotcm\ExportPDF\Domain\ValueObject\Src;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

class ImageSVG
{
    /**
     * @var string svg value
     */
    protected $file;

    /**
     * @var float x value
     */
    protected $x;

    /**
     * @var float y value
     */
    protected $y;

    /**
     * @var mixed width value
     */
    protected $w;

    /**
     * @var mixed height value
     */
    protected $h;

    /**
     * @var string link value
     */
    protected $link;

    /**
     * @var string align value
     */
    protected $align;

    /**
     * @var string palign value
     */
    protected $palign;

    /**
     * @var string
     */
    protected $border;

    /**
     * @var bool
     */
    protected $fitonpage;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Src $src, Coordinate $coordinate, $width = '', $height = 100, Link $link, Align $align, Align $palign, Border $border, $fitonpage = false )
    {
        $this->pdf = $pdf;
        $this->file = $src->value();
        $this->x = $coordinate->value()['x'];
        $this->y = $coordinate->value()['y'];
        $this->width = $width;
        $this->height = $height;
        $this->link = $link->value();
        $this->align = $align->value();
        $this->palign = $palign->value();
        $this->fitonpage = $fitonpage;
        $this->svgToPdf();
    }

    public function svgToPdf()
    {
        $this->pdf->ImageSVG($this->file, $this->x, $this->y, $this->width, $this->height, $this->link, $this->align, $this->palign, $this->border, $this->fitonpage);
    }
}