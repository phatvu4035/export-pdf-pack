<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Infrastructure\PDF;

class ExportingPDF extends \setasign\Fpdi\Tcpdf\Fpdi
{
    /**
     * "Remembers" the template id of the imported page
     */
    protected $tplId;

    /**
     * @var int
     */
    protected $pageId = 1;

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }
}
