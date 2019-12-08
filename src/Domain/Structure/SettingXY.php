<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;

/**
 * Class SettingXY
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class SettingXY
{
    /**
     * @var float x value
     */
    protected $x;

    /**
     * @var float y value
     */
    protected $y;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    /**
     * SettingXY constructor.
     * @param ExportingPDFService $pdf
     * @param Coordinate          $coordinate
     */
    public function __construct(ExportingPDFService $pdf, Coordinate $coordinate)
    {
        $this->pdf = $pdf;
        $this->x = $coordinate->value()['x'];
        $this->y = $coordinate->value()['y'];
        $this->setXY();
    }

    /**
     * set X and Y to start render after call
     */
    public function setXY(): void
    {
        $this->pdf->SetXY($this->x, $this->y);
    }
}
