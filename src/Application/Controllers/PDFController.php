<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Application\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';

use Dotcm\ExportPDF\Application\Validation\InputValidation;
use Dotcm\ExportPDF\Domain\PDF\PDF;
use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;

class PDFController
{
    /**
     * @var object
     *             Validating input
     */
    protected $validate;

    public function __construct()
    {
        $this->validate = new InputValidation();
    }

    public function exportPDF(array $files, array $config, array $data, array $initialData = []): void
    {
        /* Get general config page*/
        $pdf = null;
        $output_file_name = 'doc.pdf';
        foreach ($config as $pageId => $input) {
            $PDFfile = new PDF($files[$pageId]);

            if (null === $pdf) {
                $startFile = $PDFfile;
                $pdf = new ExportingPDFService($startFile, $initialData);
            }
            $pdf->renderPage($PDFfile, $input, $data[$pageId]);
            $output_file_name = (!empty($input['output_file_name'])) ? $input['output_file_name'] : $output_file_name;
        }
        $pdf->Output($output_file_name);
    }
}
