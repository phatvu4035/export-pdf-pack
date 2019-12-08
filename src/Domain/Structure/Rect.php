<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Color;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\Style;
use Dotcm\ExportPDF\Domain\ValueObject\Width;

class Rect
{
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
    protected $style;

    /**
     * @var array
     */
    protected $color;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Coordinate $coordinate, Width $width, Height $height, Style $style, Color $color)
    {
        $this->pdf = $pdf;
        $this->x = $coordinate->value()['x'];
        $this->y = $coordinate->value()['y'];
        $this->width = $width->value();
        $this->height = $height->value();
        $this->style = $style->value();
        $this->color = $color->value();
        $this->rectToPdf();
    }

    /**
     * render rect to pdf
     */
    public function rectToPdf(): void
    {
        $this->pdf->SetFillColor($this->color['r'], $this->color['g'], $this->color['b']);
        $this->pdf->Rect($this->x, $this->y, $this->width, $this->height, $this->style);
    }
}
