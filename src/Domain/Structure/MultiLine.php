<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\Border;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Fill;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\Text;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

/**
 * Class MultiLineValue
 * @package value object contain the info of multiple line render in PDF
 */
class MultiLine
{
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
    protected $txt;

    /**
     * @var mixed
     */
    protected $border;

    /**
     * @var string
     */
    protected $align;

    /**
     * @var bool
     */
    protected $fill;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    /**
     * @param mixed $x
     * @param mixed $y
     * @param mixed $width
     * @param mixed $height
     * @param mixed $txt
     * @param mixed $border
     * @param mixed $align
     * @param mixed $fill
     * @return bool
     */
    public function __construct(ExportingPDFService $pdf, Width $width, Height $height, Text $txt, Border $border, Align $align, Fill $fill)
    {
        $this->pdf = $pdf;
        $this->width = $width->value();
        $this->height = $height->value();
        $this->txt = $txt->value();
        $this->border = $border->value();
        $this->align = $align->value();
        $this->fill = $fill->value();
        $this->multiLineToPdf();
    }

    /**
     *  place multiple text line in pdf
     */
    protected function multiLineToPdf(): void
    {
        $this->pdf->MultiCell($this->width, $this->height, $this->txt, $this->border, $this->align, $this->fill);
    }
}
