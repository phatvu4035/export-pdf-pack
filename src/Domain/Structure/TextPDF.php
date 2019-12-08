<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Color;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\FontSize;
use Dotcm\ExportPDF\Domain\ValueObject\FontWeigth;
use Dotcm\ExportPDF\Domain\ValueObject\Link;
use Dotcm\ExportPDF\Domain\ValueObject\Text;
use Dotcm\ExportPDF\Domain\ValueObject\TextValue;

/**
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class TextPDF
{
    /**
     * @var string
     */
    protected $txt;

    /**
     * @var array
     */
    protected $color = [];

    /**
     * @var string
     */
    protected $link = '';

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Text $txt, Link $link, Color $color)
    {
        $this->pdf = $pdf;
        $this->txt = $txt->value();
        $this->link = $link->value();
        $this->color = $color->value();
        $this->textToPDF();
    }

    public function textToPDF(): void
    {
        if (!empty($this->color)) {
            $this->pdf->SetTextColor($this->color['r'], $this->color['g'], $this->color['b']);
        }
        $this->pdf->Write(0, $this->txt, $this->link);
    }
}
