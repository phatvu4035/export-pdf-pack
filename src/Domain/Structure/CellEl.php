<?php


namespace Dotcm\ExportPDF\Domain\Structure;


use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\Border;
use Dotcm\ExportPDF\Domain\ValueObject\Fill;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\Link;
use Dotcm\ExportPDF\Domain\ValueObject\Ln;
use Dotcm\ExportPDF\Domain\ValueObject\Text;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

/**
 * Class Cell
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class CellEl
{
    /**
     * @var float $width value
     */
    protected $width;

    /**
     * @var float $height value
     */
    protected $height;

    /**
     * @var string
     */
    protected $txt;

    /**
     * @var string $border value
     */
    protected $border;

    /**
     * @var int ln value
     */
    protected $ln;

    /**
     * @var string
     */
    protected $align;

    /**
     * @var bool
     */
    protected $fill;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var object
     */
    protected $pdf;

    /**
     * Cell constructor.
     * @param ExportingPDFService $pdf
     * @param Width $width
     * @param Height $height
     * @param Text $txt
     * @param Border $border
     * @param Ln $ln
     * @param Fill $fill
     * @param Align $align
     * @param Link $link
     */
    public function __construct(ExportingPDFService $pdf, Width $width, Height $height, Text $txt, Border $border, Ln $ln, Align $align, Fill $fill, Link $link)
    {
        $this->pdf = $pdf;
        $this->width = $width->value();
        $this->height = $height->value();
        $this->txt = $txt->value();
        $this->border = $border->value();
        $this->ln = $ln->value();
        $this->align = $align->value();
        $this->fill = $fill->value();
        $this->link = $link->value();
        $this->cellToPdf();
    }

    /**
     *
     */
    public function cellToPdf()
    {
        $this->pdf->Cell($this->width, $this->height, $this->txt, $this->border, $this->ln, $this->align, $this->fill, $this->link);
    }
}