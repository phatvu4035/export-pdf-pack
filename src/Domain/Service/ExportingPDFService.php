<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Service;

use Dotcm\ExportPDF\Domain\PDF\PDF;
use Dotcm\ExportPDF\Domain\Structure\Font;
use Dotcm\ExportPDF\Domain\Structure\FontAwesomeClass;
use Dotcm\ExportPDF\Domain\Structure\Image;
use Dotcm\ExportPDF\Domain\Structure\ImageSVG;
use Dotcm\ExportPDF\Domain\Structure\Line;
use Dotcm\ExportPDF\Domain\Structure\MarkupPDF;
use Dotcm\ExportPDF\Domain\Structure\MultiLine;
use Dotcm\ExportPDF\Domain\Structure\Rect;
use Dotcm\ExportPDF\Domain\Structure\SettingXY;
use Dotcm\ExportPDF\Domain\Structure\Table;
use Dotcm\ExportPDF\Domain\Structure\TextPDF;
use Dotcm\ExportPDF\Domain\ValueObject\Align;
use Dotcm\ExportPDF\Domain\ValueObject\Border;
use Dotcm\ExportPDF\Domain\ValueObject\Cell;
use Dotcm\ExportPDF\Domain\ValueObject\Color;
use Dotcm\ExportPDF\Domain\ValueObject\ColumnWidths;
use Dotcm\ExportPDF\Domain\ValueObject\Coordinate;
use Dotcm\ExportPDF\Domain\ValueObject\Fill;
use Dotcm\ExportPDF\Domain\ValueObject\FontSize;
use Dotcm\ExportPDF\Domain\ValueObject\FontWeigth;
use Dotcm\ExportPDF\Domain\ValueObject\Height;
use Dotcm\ExportPDF\Domain\ValueObject\ImageType;
use Dotcm\ExportPDF\Domain\ValueObject\Link;
use Dotcm\ExportPDF\Domain\ValueObject\Ln;
use Dotcm\ExportPDF\Domain\ValueObject\LnTCPDF;
use Dotcm\ExportPDF\Domain\ValueObject\Reseth;
use Dotcm\ExportPDF\Domain\ValueObject\Src;
use Dotcm\ExportPDF\Domain\ValueObject\Style;
use Dotcm\ExportPDF\Domain\ValueObject\Text;
use Dotcm\ExportPDF\Domain\ValueObject\Width;
use Dotcm\ExportPDF\Infrastructure\PDF\ExportingPDF;
use TCPDF_FONTS;
use Dotcm\ExportPDF\Domain\Structure\CellEl;

/**
 * Exporting to PDF
 */
class ExportingPDFService extends ExportingPDF
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var object
     */
    protected $file;

    /**
     * @var int
     */
    protected $pageId = 1;

    /**
     * @var string font for page
     */
    public $font;

    public function __construct(PDF $pdf, array $initialData = [])
    {
        $this->file = $pdf;
        $this->config = $initialData;
        $orientation = empty($initialData['orientation']) ? 'P' : $initialData['orientation'];
        $unit = empty($initialData['unit']) ? 'mm' : $initialData['unit'];
        $format = empty($initialData['format']) ? 'A4' : $initialData['format'];
        $unicode = empty($initialData['unicode']) ? true : $initialData['unicode'];
        $encoding = empty($initialData['encoding']) ? true : $initialData['encoding'];
        $diskcache = empty($initialData['diskcache']) ? false : $initialData['diskcache'];
        $pdfa = empty($initialData['pdfa']) ? false : $initialData['pdfa'];

        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    /**
     * Overwrite header
     */
    public function Header(): void
    {
        $this->setSourceFile($this->file->getFile());

        $this->tplId = $this->importPage(1);

        $size = $this->useImportedPage($this->tplId);
        $this->generalConfig();
    }

    /**
     * This function loop through the config and data to render to pdf
     * Put data in template
     * @param PDF $file
     * @param $input
     * @param $data
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    public function renderPage(PDF $file, $input, $data): void
    {
        $this->file = $file;
        $this->config = $input;
        $this->generalCurrentPageConfig($this->file->getFile(), $this->config);
        foreach ($data as  $key => $value) {
            // Config index is equal to data config
            $dataConfig = $input['data'][$key] ?? [];
            // Normalise input
            $x = $dataConfig['x'] ?? 0;
            $y = $dataConfig['y'] ?? 0;
            $txt = $value['txt'] ?? '';
            $border = $dataConfig['border'] ?? '0';
            $align = $dataConfig['align'] ?? '';
            $fill = $dataConfig['fill'] ?? false;
            $link = $value['link'] ?? '';
            $ln = $dataConfig['ln'] ?? 0;
            $color = $value['color'] ?? '';
            $font_weight = $dataConfig['font_weight'] ?? '';
            $font_size = $dataConfig['font_size'] ?? null;
            $x1 = $dataConfig['x1'] ?? 0;
            $y1 = $dataConfig['y1'] ?? 0;
            $x2 = $dataConfig['x2'] ?? 0;
            $y2 = $dataConfig['y2'] ?? 0;

            $file = $value['file'] ?? '';
            $width = $dataConfig['width'] ?? 0;
            $height = $dataConfig['height'] ?? 0;
            $type = $dataConfig['type'] ?? '';

            $column_widths = $dataConfig['column_widths'] ?? 0;
            $header = $dataConfig['header'] ?? [];
            $table_data = $value['data'] ?? [];
            $header_height = $dataConfig['header_height'] ?? 0;
            $row_height = $dataConfig['row_height'] ?? 0;
            $header_align = $dataConfig['header_align'] ?? '';
            $row_align = $dataConfig['row_align'] ?? '';

            $style = $dataConfig['style'] ?? '';

            $lnTcPDF = $dataConfig['lnTcPDF'] ?? false;
            $reseth = $dataConfig['reseth'] ?? false;
            $cell = $dataConfig['cell'] ?? false;
            $palign = $dataConfig['palign'] ?? '';
            $fitonpage = $dataConfig['fitonpage'] ?? false;
            $autoloading = $dataConfig['autoloading'] ?? false;

            // if x , y are set we can set new starting position
            if (!empty($x) && !empty($y)) {
                new SettingXY($this, new Coordinate($x, $y));
            }

            // if font is set we set font to the following render
            new Font($this, new FontWeigth($font_weight), new FontSize($font_size));
            if (!empty($dataConfig)) {
                if (!empty($dataConfig['function']) && 'text' === $dataConfig['function']) {
                    $color = !empty($dataConfig['color']) ? new Color($dataConfig['color']['r'], $dataConfig['color']['g'], $dataConfig['color']['b']) : new Color();
                    new TextPDF($this, new Text($txt), new Link($link), $color);

                    // Go back to general set up of current page
                    $this->generalConfig();
                } elseif (!empty($dataConfig['function']) && 'image' === $dataConfig['function']) {

                    new Image($this, new Src($file), new Width($width), new Height($height), new ImageType($type), new Link($link));
                } elseif (!empty($dataConfig['function']) && 'line' === $dataConfig['function']) {
                    new Line($this, new Coordinate($x1, $y1), new Coordinate($x2, $y2));
                } elseif (!empty($dataConfig['function']) && 'multi_line' === $dataConfig['function']) {
                    new MultiLine($this, new Width($width), new Height($height), new Text($txt), new Border($border), new Align($align), new Fill($fill));
                } elseif (!empty($dataConfig['function']) && 'table' === $dataConfig['function']) {
                    new Table($this, new Coordinate($x, $y), new Height($header_height), new Height($row_height), new ColumnWidths($column_widths), new Align($align), $header, $table_data);
                } elseif (!empty($dataConfig['function']) && 'rect' === $dataConfig['function']) {
                    $color = !empty($dataConfig['color']) ? new Color($dataConfig['color']['r'], $dataConfig['color']['g'], $dataConfig['color']['b']) : new Color();
                    new Rect($this, new Coordinate($x, $y), new Width($width), new Height($height), new Style($style), $color);
                } elseif (!empty($dataConfig['function']) && 'html' === $dataConfig['function']) {
                    new MarkupPDF($this, new Coordinate($x, $y), new Width($width), new Height($height), new Text($txt), new Border($border), new LnTCPDF($lnTcPDF), new Fill($fill), new Reseth($reseth), new Align($align), $autoloading);
                }  elseif (!empty($dataConfig['function']) && 'font_awesome' === $dataConfig['function']) {
                    new FontAwesomeClass($this, new Text($txt));
                } elseif(!empty($dataConfig['function']) && 'svg' === $dataConfig['function']) {
                    $height = ($height === 0) ? '' : $height;
                    $width = ($width === 0) ? '' : $width;
                    new ImageSVG($this, new Src($file), new Coordinate($x, $y), $height, $width, new Link($link), new Align($align), new Align($palign), new Border($border), $fitonpage);
                } elseif (!empty($dataConfig['function']) && 'cell' === $dataConfig['function']) {
                    new CellEl($this, new Width($width), new Height($height), new Text($txt), new Border($border), new Ln($ln), new Align($align), new Fill($fill), new Link($link));
                }
            }

            $this->generalConfig();
        }
    }

    /**
     * @return array
     */
    public function getCurrentConfig()
    {
        return $this->config;
    }

    /**
     * General set up of page
     */
    public function generalConfig(): void
    {
        $input = $this->config;
        $_font_class = new TCPDF_FONTS();
//        $this->font = $_font_class->addTTFfont(__DIR__.'/../../font/d-monthly.ttf');
        $this->font = $_font_class->addTTFfont(__DIR__.'/../../font/migmix-1p-regular.ttf');
        $this->SetFont($this->font, $input['font_weight'], $input['font_size']);
        $this->SetTextColor(0);
        $this->SetXY(PDF_MARGIN_LEFT, 5);
    }

    /**
     * Use this to config for the whole page
     * @param $file
     * @param $config
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    protected function generalCurrentPageConfig($file, $config): void
    {
        if (isset($config['title'])) {
            $this->setTitle($config['title']);
        }
        if(!empty($config['width']) && !empty($config['height'])) {
            $this->AddPage('L', [$config['width'], $config['height']]);
            $this->SetAutoPageBreak(false);
        } else {
            $this->AddPage();
        }
        $this->setSourceFile($file);
        $a = $this->importPage(1);
        $this->useImportedPage($a);
        $this->SetFont($this->font, $config['font_weight'], $config['font_size']);


    }
}
