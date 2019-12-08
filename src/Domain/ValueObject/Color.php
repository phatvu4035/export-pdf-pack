<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Color value
 */
final class Color
{
    /**
     * @var int red code
     */
    protected $r;

    /**
     * @var int green code
     */
    protected $g;

    /**
     * @var int blue code
     */
    protected $b;

    /**
     * RGB Color constructor.
     * @param int $r
     * @param int $g
     * @param int $b
     */
    public function __construct(int $r = null, int $g = null, int $b = null)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }

    /**
     * @return array full rgb color code
     */
    public function value()
    {
        return ['r' => $this->r, 'g' => $this->g, 'b' => $this->b];
    }
}
