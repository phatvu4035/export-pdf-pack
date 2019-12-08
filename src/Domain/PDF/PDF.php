<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\PDF;

class PDF
{
    /**
     * @var string
     */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
}
