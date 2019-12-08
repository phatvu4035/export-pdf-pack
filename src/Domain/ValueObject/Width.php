<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Width value
 */
final class Width
{
    /**
     * @var float width
     */
    protected $width;

    /**
     * Width constructor.
     * @param float $width
     */
    public function __construct(float $width = 0)
    {
        $this->width = $width;
    }

    /**
     * @return float width value
     */
    public function value()
    {
        return $this->width;
    }
}
