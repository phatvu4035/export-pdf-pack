<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * height value
 */
class Height
{
    /**
     * @var float
     */
    protected $height;

    /**
     * Height constructor.
     * @param float $height
     */
    public function __construct(float $height = 0)
    {
        $this->height = $height;
    }

    /**
     * @return float height value
     */
    public function value()
    {
        return $this->height;
    }
}
