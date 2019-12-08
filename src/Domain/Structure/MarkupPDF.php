<?php
namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\Border;
use Dotcm\ExportPDF\Domain\ValueObject\Cell;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Fill;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\Ln;
use Dotcm\ExportPDF\Domain\ValueObject\LnTCPDF;
use Dotcm\ExportPDF\Domain\ValueObject\Reseth;
use Dotcm\ExportPDF\Domain\ValueObject\Text;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

/**
 * Class MarkupPDF
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class MarkupPDF
{
    /**
     * @var mixed x value
     */
    protected $x;

    /**
     * @var mixed
     */
    protected $y;

    /**
     * @var mixed
     */
    protected $width;

    /**
     * @var mixed
     */
    protected $height;
    /**
     * @var string html string
     */
    protected $txt;

    /**
     * @var mixed $border value
     */
    protected $border;


    /**
     * @var bool ln value
     */
    protected $ln;

    /**
     * @var bool
     */
    protected $fill;

    /**
     * @var bool
     */
    protected $reseth;


    /**
     * @var string
     */
    protected $align;

    /**
     * @var bool autoloading value
     */
    protected $autoloading;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Coordinate $coordinate, Width $width, Height $height, Text $txt, Border $border, LnTCPDF $ln, Fill $fill, Reseth $reseth,Align $align, bool $autopadding  )
    {
        $this->pdf = $pdf;
        $this->x = $coordinate->value()['x'];
        $this->y = $coordinate->value()['y'];
        $this->width = $width->value();
        $this->height = $height->value();
        $this->txt = $txt->value();
        $this->border = $border->value();
        $this->ln = $ln->value();
        $this->fill = $fill->value();
        $this->reseth = $reseth->value();
        $this->align = $align->value();
        $this->autoloading = $autopadding;
        $this->markupToPdf();
    }

    /**
     * render html to pdf
     */
    public function markupToPdf()
    {
        $this->pdf->writeHTMLCell($this->width, $this->height, $this->x, $this->y, $this->txt, $this->border, $this->ln, $this->fill, $this->reseth, $this->align, $this->autoloading);
    }
}
