<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

final class LineValue
{
    /**
     * @var int
     *          Abscissa of first point
     */
    protected $x1;

    /**
     * @var int
     *          Ordinate of first point
     */
    protected $y1;

    /**
     * @var int
     *          Abscissa of second point
     */
    protected $x2;

    /**
     * @var int
     *          Ordinate of second point
     */
    protected $y2;

    /**
     * @var array
     */
    protected $color;

    public function __construct($x1, $y1, $x2, $y2, $color = [])
    {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
    }

    /**
     * @return int
     */
    public function getX1()
    {
        return $this->x1;
    }

    /**
     * @return int
     */
    public function getY1()
    {
        return $this->y1;
    }

    /**
     * @return int
     */
    public function getX2()
    {
        return $this->x2;
    }

    /**
     * @return int
     */
    public function getY2()
    {
        return $this->y2;
    }

    /**
     * @return array
     */
    public function getColor()
    {
        return $this->color;
    }
}
