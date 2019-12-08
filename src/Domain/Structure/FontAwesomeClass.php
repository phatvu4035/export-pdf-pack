<?php


namespace Dotcm\ExportPDF\Domain\Structure;


use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Text;

/**
 * Class FontAwesomeClass
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class FontAwesomeClass
{
    /**
     * @var string
     */
    protected $txt;

    /**
     * @var object Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Text $txt)
    {

        $this->pdf = $pdf;
        $this->txt = $txt;
        $this->fontAwesomeToPdf();
    }

    public function fontAwesomeToPdf()
    {
        $this->pdf->AddFont('fontawesomewebfont', '');
        $this->pdf->SetFont('fontawesomewebfont', '', 14, '', true);

// following works:
        $this->pdf->SetFont('fontawesomewebfont');
        $this->pdf->writeHTML("\f03e"); // single icon
//        $this->pdf->writeHTMLCell("&#xf0a4;&#xf01d;&#xf03e;"); // three icons
        $this->pdf->generalConfig();
    }
}