<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Color;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;

class Line
{
    /**
     * @var int
     *          Abscissa of first point
     */
    protected $x1;

    /**
     * @var int
     *          Ordinate of first point
     */
    protected $y1;

    /**
     * @var int
     *          Abscissa of second point
     */
    protected $x2;

    /**
     * @var int
     *          Ordinate of second point
     */
    protected $y2;

    /**
     * @var array
     *            array of rgb value
     */
    protected $color;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Coordinate $coordinate1, Coordinate $coordinate2, Color $color)
    {
        $this->x1 = $coordinate1->value()['x'];
        $this->y1 = $coordinate1->value()['y'];
        $this->x2 = $coordinate2->value()['x'];
        $this->y2 = $coordinate2->value()['y'];
        $this->color = $color->value();
        $this->lineToPdf();
    }

    /**
     * draw line tp pdf
     */
    protected function lineToPdf(): void
    {
        $this->pdf->SetDrawColor($this->color['r'], $this->color['g'], $this->color['b']);
        $this->Line($this->x1, $this->y1, $this->x2, $this->y2);
    }
}
