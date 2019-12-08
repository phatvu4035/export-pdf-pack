<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * TextPDF value
 * */
final class Coordinate
{
    /**
     * @var float Abscissa
     */
    protected $x;

    /**
     * @var float Ordinate
     */
    protected $y;

    public function __construct(float $x = 0, float $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return array Coordinate value
     */
    public function value()
    {
        return ['x' => $this->x, 'y' => $this->y];
    }
}
