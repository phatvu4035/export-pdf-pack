<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

use Dotcm\ExportPDF\Domain\Service\ExportingPDFService;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\ColumnWidths;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Height;

class Table
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    /**
     * @var array
     */
    protected $column_widths;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var float
     */
    protected $header_height;

    /**
     * @var float
     */
    protected $row_height;

    /**
     * @var string
     */
    protected $row_align;

    /**
     * @var Dotcm\ExportPDF\Domain\Service\ExportingPDFService
     */
    protected $pdf;

    public function __construct(ExportingPDFService $pdf, Coordinate $coordinate, Height $header_height, Height $row_height, ColumnWidths $column_widths, Align $align, $header = [], $data = [])
    {
        $this->pdf = $pdf;
        $this->x = $coordinate->value()['x'];
        $this->y = $coordinate->value()['y'];
        $this->column_widths = $column_widths->value();
        $this->header_height = $header_height->value();
        $this->row_height = $row_height->value();
        $this->header = $header;
        $this->row_align = $align->value();
        $this->data = $data;
        $this->tableToPdf();
    }

    /**
     * render table to pdf
     */
    public function tableToPdf(): void
    {
        $this->pdf->SetXY($this->x, $this->y);

        // Header
        $count_colums_header = count($this->header);

        for ($i = 0; $i < $count_colums_header; $i++) {
            $this->pdf->Cell($this->column_widths[$i], $this->header_height, $this->header[$i], 1, 0, $this->row_align);
        }

        $this->pdf->Line($this->x, $this->y + 7, $this->x + array_sum($this->column_widths), $this->y + 7);
        // Data
        $index = 1;

        foreach ($this->data as $row) {
            $this->pdf->SetXY($this->x, $this->y + $this->row_height * $index);

            for ($i = 0; $i < $count_colums_header; $i++) {
                $this->pdf->Cell($this->column_widths[$i], $this->row_height, $row[$i], 'LR', 0, $this->row_align);
            }
            $this->pdf->Line($this->x, $this->y, $this->x, $this->y + $this->row_height * $index);
            $index++;
            $this->pdf->Line($this->x, $this->y + $this->row_height * $index, $this->x + array_sum($this->column_widths), $this->y + $this->row_height * $index);
        }
    }
}
