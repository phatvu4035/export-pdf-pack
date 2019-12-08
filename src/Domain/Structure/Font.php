<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\FontSize;
use Dotcm\ExportPDF\Domain\ValueObject\FontWeigth;

/**
 * Class Font
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class Font
{
    /**
     * @var string
     */
    protected $font_family;

    /**
     * @var string font weight value
     */
    protected $font_weight;

    /**
     * @var int font size value
     */
    protected $font_size;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, FontWeigth $font_weight, FontSize $font_size)
    {
        $this->pdf = $pdf;
        $this->font_weight = $font_weight->value();
        $this->font_size = $font_size->value();
        $this->fontToPdf();
    }

    /**
     * set font to render to pdf
     */
    public function fontToPdf(): void
    {
        $font_weight = '';
        $font_size = null;

        if ($this->pdf->getCurrentConfig()['font_weight']) {
            $font_weight = $this->pdf->getCurrentConfig()['font_weight'];
        }

        if ($this->font_weight) {
            $font_weight = $this->font_weight;
        }

        if ($this->pdf->getCurrentConfig()) {
            $font_size = $this->pdf->getCurrentConfig()['font_size'];
        }

        if ($this->font_size) {
            $font_size = $this->font_size;
        }
        $this->pdf->SetFont($this->pdf->font, $font_weight, $font_size);
    }
}
